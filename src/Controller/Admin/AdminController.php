<?php

namespace App\Controller\Admin;

use App\Entity\Gite;
use App\Form\GiteType;
use App\Repository\GiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

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
    public function index() : Response  {

        $gites = $this->giteRepository->findAll();
        return $this->render('admin/index.html.twig', [
            "gites" => $gites
        ]);
    }

    /**
     * @Route("/admin/newG", name="admin.newG")
     */
    public function newG(Request $request) : Response {

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
     * @Route("/admin/{id}", name="admin.edit" , methods={"GET","POST"})
     */
    public function edit(Gite $gite, Request $request) : Response {

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

    /**
     * @Route("/{id}", name="admin.delete", methods={"POST"})
     */
    public function delete(Gite $gite, Request $request) 
    {        
        if ($this->isCsrfTokenValid('delete-item'.$gite->getId(),$request->request->get('_token') )) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gite);
            $em->flush();
            
        }       
        return $this->redirectToRoute("admin.index");
    }
}