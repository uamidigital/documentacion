<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VersionController extends AbstractController
{
    #[Route('/version', name: 'app_version')]
    public function index(): Response
    {
        return $this->render('version/index.html.twig', [
            'controller_name' => 'VersionController',
        ]);
    }
}
