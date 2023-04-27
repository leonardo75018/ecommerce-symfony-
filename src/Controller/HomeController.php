<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Product;
use App\Form\ProductType;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'property.index')]
    public function index(EntityManagerInterface $em, Request  $request, CartService $cartService): Response
    {


        // $cartService->revoveCartAll();

        $product = new Product();
        $productForm = $this->createForm(ProductType::class, $product);
        $productForm->handleRequest($request);

        if ($productForm->isSubmitted() && $productForm->isValid()) {
            $em->persist($product);
            $em->flush();
        }



        $products = $em->getRepository(Product::class)->findAll();

        return $this->render('home/index.html.twig', [
            'productForm' => $productForm,
            "products" => $products
        ]);
    }
}
