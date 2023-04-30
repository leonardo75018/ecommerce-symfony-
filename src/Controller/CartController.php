<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

    #[Route('/cart', name: 'cart.index')]
    public function index(CartService $cartService): Response
    {
        return $this->render("card/index.html.twig", [
            "carts" => $cartService->getTotal()
        ]);
    }

    //Ajouter produit au panier

    #[Route('/cart/add/{id<\d+>}', name: 'cart_add')]
    public function addToRoute(CartService $cartService, int $id): Response
    {
        $cartService->addToCart($id);
        return $this->redirectToRoute("property.shop");
    }

    #[Route('/cart/remove/{id<\d+>}', name: 'cart_remove')]
    public function removeToCart(CartService $cartService, int $id): Response
    {
        $cartService->removeToCart($id);
        return $this->redirectToRoute('property.shop');
    }

    #[Route('/cart/decrease/{id<\d+>}', name: 'cart_decrease')]
    public function decrease(CartService $cartService, $id): RedirectResponse
    {
        $cartService->decrease($id);

        return $this->redirectToRoute('property.shop');
    }

    #[Route('/cart/increment/{id<\d+>}', name: 'cart_increment')]
    public function icrementQuantity(CartService $cartService, $id): RedirectResponse
    {
        $cartService->icrementQuantity($id);
        return $this->redirectToRoute('property.shop');
    }


    //Creation du panier 









}
