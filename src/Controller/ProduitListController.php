<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProduitRepository;

final class ProduitListController extends AbstractController
{
     #[Route('/produit/list', name: 'app_produit_list')]
    public function index(ProduitRepository $repo): Response
    {
        $produits = $repo->findAll();

        return $this->render('produit_list/index.html.twig', [
            'produits' => $produits,
        ]);
    }
}
