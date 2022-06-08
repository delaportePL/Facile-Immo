<?php

namespace App\Controller;

use App\Repository\OffreRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $offreRepository;

    public function __construct(
        OffreRepository $offreRepository)
    {
        $this->offreRepository = $offreRepository;
    }

    #[Route('/', name: 'offre.liste')]
    public function offreListe(): Response
    {
        /**
         * @var Security
         */
        $user = $this->getUser();
        $userId = $user->getId();
        
        if($user){
            $offres = $this->offreRepository->findAllOffersByUserId($userId);
            dump($offres);
            $offres = array_filter($offres, function($value){
                return $value['liked_offre_type']!==0;
            });
        }else{
            $offres = $this->offreRepository->findAll();
        }
        
        dump($offres);
        return $this->render('home/index.html.twig', [
            'offres' => $offres,
        ]);
    }

    #[Route('/offre-{id}', name: 'offre.detail', methods:['GET', 'HEAD'])]
    public function offreDetail($id): Response
    {
        $offre = $this->offreRepository->find($id);
        
        return $this->render('offre/index.html.twig', [
            'offre' => $offre,
        ]);
    }
}
