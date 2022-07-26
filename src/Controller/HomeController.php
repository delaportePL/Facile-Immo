<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchFormType;
use App\Repository\OffreRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(
        OffreRepository $offreRepository)
    {
        $this->offreRepository = $offreRepository;
    }

    #[Route('/', name: 'home')]
    public function home(): Response
    {
        /**
         * @var User
         */
        $user = $this->getUser();

        return $this->render('home/index.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/comment-acheter', name: 'acheter')]
    public function acheter(): Response
    {
        return $this->render('acheter/index.html.twig');
    }

}
