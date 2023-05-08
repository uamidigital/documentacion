<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DivisionController extends AbstractController
{
    #[Route('/division', name: 'app_division')]
    public function index(): Response
    {
        return $this->render('division/index.html.twig', [
            'controller_name' => 'DivisionController',
        ]);
    }
}
