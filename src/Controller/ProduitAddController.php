<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitTypeForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitAddController extends AbstractController
{
    #[Route('/produit/add', name: 'app_produit_add')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitTypeForm::class, $produit);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $produit->setCreatedAt(new \DateTimeImmutable());
            $em->persist($produit);
            $em->flush();
            return $this->redirectToRoute('app_produit_list');
        }

        return $this->render('produit_add/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
