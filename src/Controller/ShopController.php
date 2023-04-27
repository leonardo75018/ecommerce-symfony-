<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    #[Route('/shop', name: 'property.shop')]
    public function index(EntityManagerInterface $em, CartService $cartService): Response
    {

        $product = new Product();
        $products = $em->getRepository(Product::class)->findAll();
        return $this->render('shop/index.html.twig', [
            "products" => $products,
            "carts" => $cartService->getTotal()
        ]);
    }

    #[Route('/products/{id}', name: 'property.show')]
    public function ShowOneProduct(EntityManagerInterface $em,  $id): Response
    {

        $product = $em->getRepository(Product::class)->find($id);

        return $this->render('shop/one_product.html.twig', [
            "product" => $product
        ]);
    }
}
