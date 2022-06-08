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


    #[Route('/profil', name: 'profil')]
    public function profil(): Response
    {
        /**
         * @var Security
         */
        $user = $this->getUser();
        $userId = $user->getId();
        $offresAimees = $this->offreRepository->findLikedOffresByUserIdAndType($userId, 1);

        return $this->render('profil/index.html.twig', [
            'user' => $user,
            'offresAimees' => $offresAimees,
        ]);
    }

    #[Route('/profil/offre-masquee', name: 'profil.offre.masquee')]
    public function offreMasquee(): Response
    {
        /**
        * @var Security
        */
        $user = $this->getUser();
        $userId = $user->getId();
        $offresMasquees = $this->offreRepository->findLikedOffresByUserIdAndType($userId, 0);

        return $this->render('profil/offre-masquee.html.twig', [
            'user' => $user,
            'offresMasquees' => $offresMasquees
        ]);
    }
}
