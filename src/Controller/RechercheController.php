<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchFormType;
use App\Repository\OffreRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


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
        $arrayOffers = $qb->getQuery()->getArrayResult();

        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        
        $serializer = new Serializer($normalizers, $encoders);

        $jsonOffers = [];
        foreach($arrayOffers as $offer){
            $offer['image_1'] = null;
            $offer['image_2'] = null;
            $offer['image_3'] = null;
            $jsonOffers[] = $offer;
        }
        $jsonOffers = $serializer->serialize($jsonOffers, 'json');

        /*Ici on ajoute la pagination avec le paramètre 'page' récupéré dans l'url avec la méthode request->get() 
        Le deuxième paramètre de get est sa valeur par défaut */
        $pagination = $paginator->paginate(
            $paginationQB,
            $request->get('page', 1),
            5
        );
        return $this->render('recherche/index.html.twig', [
            'form' => $form->createView(),
            'pagination' => $pagination,
            'offers' => $offers,
            'jsonOffers' => $jsonOffers,
        ]);

    }
}
