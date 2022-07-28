<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Entity\OffreLike;
use App\Entity\OffreDislike;

use App\Repository\OffreLikeRepository;
use App\Repository\OffreDislikeRepository;
use App\Repository\OffreRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffreController extends AbstractController
{
    private $offreRepository;

    public function __construct(
        OffreRepository $offreRepository,
        OffreLikeRepository $offreLikeRepository,
        OffreDislikeRepository $offreDislikeRepository,
        )
    {
        $this->offreRepository = $offreRepository;
        $this->offreLikeRepository = $offreLikeRepository;
        $this->offreDislikeRepository = $offreDislikeRepository;
    }

    /** 
     * Récupère l'offre dont l'id est envoyé en paramètre dans l'URL
     * Affiche l'offre en détail (prix, surface, localisation...) dans une page dédiée 
    */
    #[Route('/offre-{id}', name: 'offre.detail', methods:['GET', 'HEAD'])]
    public function offreDetail($id): Response
    {
        $offre = $this->offreRepository->find($id);

        return $this->render('offreDetail/index.html.twig', [
            'offre' => $offre
        ]);
    }

    /**
     * Récupère l'utilisateur, s'il n'existe pas on renvoie une erreur (mais le bouton de like n'est
     * pas affiché pour les visiteurs non connectés)
     * 
     * Si l'utilisateur est connecté, il enregistre un like sur l'offre (dont l'id est présent dans l'url),
     * dans offreLikeRepository, ou le supprime s'il y a déjà un like de cet utilisateur sur la même offre
     */
    #[Route('/offre-{id}/like', name: 'offre.like')]
    public function like(Offre $offre, EntityManagerInterface $em) : Response
    {
        $user = $this->getUser();

        if(!$user) return $this->json([
            'code' => 403,
            'message' => 'Veuillez vous connecter pour aimer une annonce'
        ], 403);

        if($offre->isLikedByUser($user)){
            $like = $this->offreLikeRepository->findOneBy([
                'offre' => $offre,
                'user' => $user
            ]);

            $em->remove($like);
            $em->flush();

            return $this->json([
                'code' => 200,
                'like' => false,
                'message' => 'Like bien supprimé'
            ], 200);
        }
        $like = new OffreLike();
        $like
            ->setOffre($offre)
            ->setUser($user);
        
        $em->persist($like);
        $em->flush();

        return $this->json([
            'code'=> 200,
            'like' => true,
            'message' => 'Like bien ajouté'
        ], 200);
    }

    /**
     * Récupère l'utilisateur, s'il n'existe pas on renvoie une erreur (mais le bouton de masquage n'est
     * pas affiché pour les visiteurs non connectés)
     * 
     * Si l'utilisateur est connecté, il enregistre un dislike (masquer) sur l'offre (dont l'id est présent dans l'url),
     * dans offreDislikeRepository, ou le supprime s'il y a déjà un dislike (masquer) de cet utilisateur sur la même offre
     */
    #[Route('/offre-{id}/dislike', name: 'offre.dislike')]
    public function dislike(Offre $offre, EntityManagerInterface $em) : Response
    {
        $user = $this->getUser();

        if(!$user) return $this->json([
            'code' => 403,
            'message' => 'Veuillez vous connecter pour masquer une annonce'
        ], 403);

        if($offre->isDislikedByUser($user)){
            $dislike = $this->offreDislikeRepository->findOneBy([
                'offre' => $offre,
                'user' => $user
            ]);
            $em->remove($dislike);
            $em->flush();

            return $this->json([
                'code' => 200,
                'dislike' => false,
                'message' => "L'annonce est de nouveau visible"
            ], 200);
        }
        $dislike = new OffreDislike();
        $dislike
            ->setOffre($offre)
            ->setUser($user);
        
        $em->persist($dislike);
        $em->flush();

        return $this->json([
            'code'=> 200,
            'dislike' => true,
            'message' => "L'annonce a été masquée"
        ], 200);
    }
}