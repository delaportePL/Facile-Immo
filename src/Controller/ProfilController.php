<?php

namespace App\Controller;

use App\Repository\OffreRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    public function __construct(
        UserRepository $userRepository,
        OffreRepository $offreRepository,
    )
    {
        $this->userRepository = $userRepository;
        $this->offreRepository = $offreRepository;
    }

    /* Récupère l'utilisateur connecté puis ses likes puis les offres liées à ce like, qu'il envoie dans un tableau likedOffers */
    #[Route('/profil', name: 'profil')]
    public function profil(): Response
    {
        /**
         * @var User
         */
        $user = $this->getUser();
        $likedOffers = [];
        foreach($user->getOffreLikes() as $offre){
            array_push($likedOffers, $offre->getOffre());
        }
        
        return $this->render('profil/index.html.twig', [
            'user' => $user,
            'likedOffers' => $likedOffers,
        ]);
    }

    /* Récupère l'utilisateur connecté, puis ses dislikes, puis les offres liées à ce dislike, qu'il envoie dans un tableau dislikedOffers */
    #[Route('/profil/offres-masquees', name: 'profil.offre.masquee')]
    public function offreMasquee(): Response
    {
        /**
         * @var User
         */
        $user = $this->getUser();
        $dislikedOffers = [];
        foreach($user->getOffreDislikes() as $offre){
            array_push($dislikedOffers, $offre->getOffre());
        }

        return $this->render('profil/offre-masquee.html.twig', [
            'user' => $user,
            'dislikedOffers' => $dislikedOffers
        ]);
    }
}
