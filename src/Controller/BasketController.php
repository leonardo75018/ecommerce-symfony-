<?php

namespace App\Controller;

use App\Entity\Basket;
use App\Form\BasketType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController
{
    #[Route('/basket/create', name: 'basket_create')]
    public function index(EntityManagerInterface $em,): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $basket = new Basket();
        $basketForm = $this->createForm(BasketType::class,  null, [
            "user" => $this->getUser()
        ]);

        return $this->render('basket/index.html.twig', [
            'basketForm' => $basketForm->createView(),
        ]);
    }
}
