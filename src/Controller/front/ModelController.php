<?php

namespace App\Controller\front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModelController extends AbstractController
{
    #[Route('/model', name: 'app_model')]
    public function index(): Response
    {
        return $this->render('model/index.html.twig', [
            'controller_name' => 'ModelController',
        ]);
    }
}
