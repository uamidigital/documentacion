<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ObraController extends AbstractController
{
    #[Route('/obra', name: 'app_obra')]
    public function index(): Response
    {
        return $this->render('obra/index.html.twig', [
            'controller_name' => 'ObraController',
        ]);
    }
}
