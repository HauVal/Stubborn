<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProductsController extends AbstractController{
    #[Route('/products', name: 'app_products')]
    public function index(Request $request, ProductRepository $productRepository): Response
    {
        $priceFilter = $request->query->get('price');

        if ($priceFilter) {
            [$min, $max] = explode('-', $priceFilter);
            $products = $productRepository->createQueryBuilder('p')
                ->where('p.price >= :min AND p.price <= :max')
                ->setParameter('min', $min)
                ->setParameter('max', $max)
                ->getQuery()
                ->getResult();

        } else {
            // Si aucun filtre n'est sélectionné, récupérer tous les produits
            $products = $productRepository->findAll();
        }

        return $this->render('products/index.html.twig', [
            'products' => $products,
        ]);
    }
}
