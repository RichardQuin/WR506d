<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="product_list")
     */
    public function listProducts()
    {
        return $this->render('product/index.html.twig', [
            'title' => 'Liste des produits',
            'content' => 'Ici, vous afficherez la liste de vos produits',
        ]);
    }

    /**
     * @Route("/product/{id}", name="product_view")
     */
    public function viewProduct(Request $request, $id)
    {
        return $this->render('product/index.html.twig', [
            'title' => 'Affichage du produit',
            'content' => 'Vous affichez le produit avec l\'ID : ' . $id,
        ]);
    }
}