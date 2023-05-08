<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocumentacionController extends AbstractController
{
    #[Route('/documentacion', name: 'app_documentacion')]
    public function index(): Response
    {
        return $this->render('documentacion/index.html.twig', [
            'controller_name' => 'DocumentacionController',
        ]);
    }
}
