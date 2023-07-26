<?php

namespace App\Controller\front;

use App\Entity\Listing;
use App\Form\front\ListingType;
use App\Repository\ListingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListingController extends AbstractController
{
    public function __construct(
      private ListingRepository $listingRepository
    ) { }
    #[Route('/listing', name: 'app_listing')]
    public function index(): Response
    {
        return $this->render('listing/index.html.twig', [
            'controller_name' => 'ListingController',
        ]);
    }
    #[Route('/listing/nouveau', name: 'app_listing_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ListingRepository $listingRepository): Response
    {
        $listing = new Listing();
        $form = $this->createForm(ListingType::class, $listing);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $listingRepository->save($listing, true);

            return $this->redirectToRoute('app_home');
        }

        return $this->render('front/listing/new.html.twig', [
            'listing' => $listing,
            'form' => $form->createView(),
        ]);
    }
    #[Route('/listing/{id}', name: 'app_listing_show')]
    public function handleRedirection(string $id): Response {
        $listing = $this->listingRepository->find($id);

        if ($listing !== null) {
            return $this->show($listing);
        }
        return $this->redirectToRoute('app_home');
    }
    private function show(Listing $listing): Response
    {

        return $this->render('front/listing/show.html.twig', [
            'listing' => $listing,

        ]);
    }

}
