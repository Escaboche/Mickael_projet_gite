<?php 

namespace App\Controller;

use App\Entity\Gite;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController{


    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        // $gite = new Gite();
        // $gite
        //     ->setName('Le premier Gite')
        //     ->setDescription('Un gite de montagne')
        //     ->setSurface(90)
        //     ->setBedrooms(3)
        //     ->setAddress('25 de la Corpierre')
        //     ->setCity('BelleVille')
        //     ->setPostalCode('56222');
        
        // $em = $this->getDoctrine()->getManager();
        // $em->persist($gite);
        // $em->flush();

        return $this->render('home/index.html.twig');
    }
}