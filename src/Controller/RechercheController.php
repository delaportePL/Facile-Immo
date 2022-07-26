<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchFormType;
use App\Repository\OffreRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class RechercheController extends AbstractController
{
    public function __construct(
        OffreRepository $offreRepository)
    {
        $this->offreRepository = $offreRepository;
    }


    #[Route('/recherche', name: 'recherche')]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        /**
         * @var User
         */
        $user = $this->getUser();

        $dislikedOfferIds = [];
        if($user){
            foreach($user->getOffreDislikes() as $offre){
                $dislikedOfferIds[] = $offre->getOffre()->getId();
            }
        }

        /* On instancie l'objet $data d'après la classe SearchData qui définit les champs de SearchFormType */
        $data = new SearchData();
        $form = $this->createForm(SearchFormType::class, $data);
        $form->handleRequest($request);

        $paginationQB = $qb = $this->offreRepository->getQueryWithSearch($data, $dislikedOfferIds);

        $offers = $qb->getQuery()->getResult();
        $jsonOffers = json_encode($qb->getQuery()->getArrayResult());

        /*Ici on ajoute la pagination avec le paramètre 'page' récupéré dans l'url avec la méthode request->get() 
        Le deuxième paramètre de get est sa valeur par défaut */
        $pagination = $paginator->paginate(
            $paginationQB,
            $request->get('page', 1),
            5
        );
        // dump($offers);
        return $this->render('recherche/index.html.twig', [
            'form' => $form->createView(),
            'pagination' => $pagination,
            'offers' => $offers,
            'jsonOffers' => $jsonOffers,
        ]);

    }
}
