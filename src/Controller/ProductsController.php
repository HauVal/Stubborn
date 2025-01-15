<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductsController extends AbstractController{
    #[Route('/products', name: 'app_products')]
    public function index(Request $request, ProductRepository $productRepository): Response
    {
        $priceFilter = $request->query->get('price');
        $products = $productRepository->findAll();

        if ($priceFilter) {
            [$min, $max] = explode('-', $priceFilter);
            $products = $productRepository->createQueryBuilder('p')
                ->where('p.price >= :min AND p.price <= :max')
                ->setParameters(['min' => $min, 'max' => $max])
                ->getQuery()
                ->getResult();
        }

        return $this->render('products/index.html.twig', [
            'products' => $products,
        ]);
    }
}
