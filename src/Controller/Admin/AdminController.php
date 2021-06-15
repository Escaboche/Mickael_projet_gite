<?php

namespace App\Controller\Admin;

use App\Form\GiteType;
use App\Repository\GiteRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController {

    private GiteRepository $giteRepository;

    public function __construct(GiteRepository $giteRepository)
    {
        $this->giteRepository = $giteRepository;
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
    public function newG(){

        $form = $this->createForm(GiteType::class);
        return $this->render('admin/newG.html.twig', [
            "formGite" => $form->createView()
        ]);
    }
}