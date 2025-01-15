<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart_index')]
    public function index(CartService $cartService, ProductRepository $productRepository): Response
    {
        $cart = $cartService->getCart();
        $cartWithData = [];

        foreach ($cart as $id => $quantity) {
            $product = $productRepository->find($id);
            if ($product) {
                $cartWithData[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                ];
            }
        }

        $total = array_reduce($cartWithData, function ($sum, $item) {
            return $sum + $item['product']->getPrice() * $item['quantity'];
        }, 0);

        return $this->render('cart/index.html.twig', [
            'items' => $cartWithData,
            'total' => $total,
        ]);
    }

    #[Route('/cart/add/{id}', name: 'cart_add', methods: ['POST'])]
    public function add(int $id, CartService $cartService): Response
    {
        $cartService->add($id);
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/cart/remove/{id}', name: 'cart_remove')]
    public function remove(int $id, CartService $cartService): Response
    {
        $cartService->remove($id);
        return $this->redirectToRoute('cart_index');
    }

    #[Route('/cart/checkout', name: 'cart_checkout')]
    public function checkout(CartService $cartService): Response
    {
        $stripe = new \Stripe\StripeClient('sk_test_your_secret_key');

        $session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => array_map(function ($item) {
                return [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $item['product']->getName(),
                        ],
                        'unit_amount' => $item['product']->getPrice() * 100,
                    ],
                    'quantity' => $item['quantity'],
                ];
            }, $cartService->getCart()),
            'mode' => 'payment',
            'success_url' => 'http://localhost:8000/cart/success',
            'cancel_url' => 'http://localhost:8000/cart/cancel',
        ]);

        return $this->redirect($session->url, 303);
    }

    #[Route('/cart/success', name: 'cart_success')]
    public function success(CartService $cartService): Response
    {
        $cartService->clear();
        return $this->render('cart/success.html.twig');
    }


}

