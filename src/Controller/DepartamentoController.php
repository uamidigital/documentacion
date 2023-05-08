<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepartamentoController extends AbstractController
{
    #[Route('/departamento', name: 'app_departamento')]
    public function index(): Response
    {
        return $this->render('departamento/index.html.twig', [
            'controller_name' => 'DepartamentoController',
        ]);
    }
}
