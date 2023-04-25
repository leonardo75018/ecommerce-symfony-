<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    #[Route('/shop', name: 'property.shop')]
    public function index(EntityManagerInterface $em,): Response
    {

        $product = new Product();
        // $product->setName("Café title ")
        //     ->setPrice(20.99)
        //     ->setDescription("Product description")
        //     ->setOrigin("Mexique")
        //     ->setWeigth(1)
        //     ->setDisponibility(40);

        // $em->persist($product);
        // $em->flush();

        $products = $em->getRepository(Product::class)->findAll();
        dd($products);


        return $this->render('shop/index.html.twig', [
            'controller_name' => 'ShopController',
        ]);
    }
}
