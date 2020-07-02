<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Produit;
use App\Repository\ProduitRepository;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit/new" , name="produit_create")
     * @Route("/produit/{id}/edit" , name="produit_edit")
     */
    public function create(
        Produit $produit = null,
        Request $request,
        EntityManagerInterface $manager
    ) {
        if (!$produit) {
            $produit = new Produit();
        }

        $form = $this->createFormBuilder($produit)
            ->add('nom')
            ->add('prix')
            ->add('description')
            ->add('stock')
            ->add('photo')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($produit);
            $manager->flush();

            return $this->redirectToRoute('produit');
        }
        return $this->render('produit/create.html.twig', [
            'formProduit' => $form->createView(),
            'editMode' => $produit->getId() != null
        ]);
    }

    /**
     * @Route("/produit/{id}/remove" , name="produit_remove")
     */
    public function delete($id , EntityManagerInterface $manager){
        $manager= $this->getDoctrine()->getManager();
        $produit= $manager->getRepository(Produit :: class)->find($id);
        $manager->remove($produit);
        $manager->flush() ;
        $repo = $this->getDoctrine()->getRepository(Produit :: class) ;
        $produits = $repo->findAll();
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
            'produits' => $produits
        ]);
    }

    /**
     * @Route("/produit", name="produit")
     */
    public function index(ProduitRepository $repo)
    {
        //$repo = $this->getDoctrine()->getRepository(Produit :: class) ;
        $produits = $repo->findAll();
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
            'produits' => $produits
        ]);
    }

    /**
     * @Route("/produit/{id}" ,name="produit_show")
     */
    public function show($id)
    {
        $repo = $this->getDoctrine()->getRepository(Produit::class);
        $produit = $repo->find($id);
        return $this->render('produit/show.html.twig', [
            'produit' => $produit
        ]);
    }
}
