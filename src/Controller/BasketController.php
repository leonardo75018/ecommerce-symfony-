<?php

namespace App\Controller;

use App\Entity\Basket;
use App\Form\BasketType;
use App\Service\CartService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController
{
    #[Route('/basket/create', name: 'basket_create')]
    public function index(EntityManagerInterface $em, CartService $cartService): Response
    {
        //Creation du panier 






        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $basket = new Basket();
        $basketForm = $this->createForm(BasketType::class,  null, [
            "user" => $this->getUser()
        ]);

        $user =  $this->getUser();
        $productList =  $cartService->getTotal();
        dd($productList);




        return $this->render('basket/index.html.twig', [
            'basketForm' => $basketForm->createView(),
            "recapCart" => $cartService->getTotal()
        ]);
    }
}
