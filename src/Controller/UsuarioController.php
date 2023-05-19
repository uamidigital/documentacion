<?php

namespace App\Controller;

use App\Entity\Usuario;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractController
{
    #[Route('/usuario/{id}', name: 'app_usuario')]
    public function index(Usuario $usuario): Response
    {
        dump($usuario);
        return $this->render('usuario/index.html.twig', [
            'controller_name' => 'UsuarioController',
            'usuario'=>$usuario
        ]);
    }
}
