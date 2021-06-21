<?php 

namespace App\Controller\Gite;

use App\Repository\GiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GiteController extends AbstractController 
{
   

    private GiteRepository $repo;

    public function __construct(GiteRepository $repo)
    {
        $this->repo = $repo;
    }

     /**
     * @Route("/", name="home")
     */
    public function homeGites()
    {
        $gites = $this->repo->findLastGite();
        return $this->render('home/index.html.twig', [
            'gites' => $gites
        ]);
    }


    /**
     * @Route("/gites", name="gite.index")
     */
    public function index(GiteRepository $repo, PaginatorInterface $paginator, Request $request)
    {
        
        $pagination = $paginator->paginate(
            $repo->findAll(),
            $request->query->getInt('page', 1),
            9
        );

        return $this->render('gite/index.html.twig', [
            'pagination' => $pagination]);
    }

    /**
     *@Route("/gite/{id}", name="gite.show") 
     */
    public function show(int $id)
    {
        $gite = $this->repo->find($id);

        return $this->render('gite/show.html.twig', [
            "gite" => $gite
        ]);
    }
}

?>