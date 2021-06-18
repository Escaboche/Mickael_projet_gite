<?php

namespace App\Controller\Admin;

use App\Entity\Gite;
use App\Form\GiteType;
use App\Repository\GiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController {

    private EntityManagerInterface $em;
    private GiteRepository $giteRepository;

    public function __construct(GiteRepository $giteRepository, EntityManagerInterface $em)
    {
        $this->giteRepository = $giteRepository;
        $this->em = $em;
    }

    
    /**
     * @Route("/admin", name="admin.index")
     */
    public function index() {

        $gites = $this->giteRepository->findAll();
        return $this->render('admin/index.html.twig', [
            "gites" => $gites
        ]);
    }

    /**
     * @Route("/admin/newG", name="admin.newG")
     */
    public function newG(Request $request){

        $gite = new Gite();

        $form = $this->createForm(GiteType::class, $gite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->em->persist($gite);
            $this->em->flush();
            $this->addFlash("success", "Le gite est bien enregistré");
            return $this->redirectToRoute('admin.index');

        }

        return $this->render('admin/newG.html.twig', [
            "formGite" => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/{id}", name="admin.edit")
     */
    public function edit(Gite $gite, Request $request){

        $form = $this->createForm(GiteType::class, $gite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->em->flush();
            $this->addFlash("success", "Le gite est bien été modifier");
            return $this->redirectToRoute('admin.index');

        }

        
        
        return $this->render('admin/edit.html.twig', [
            'gite' => $gite,
            'formGite' => $form->createView()
        ]);
    }
}