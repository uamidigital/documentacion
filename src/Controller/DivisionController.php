<?php

namespace App\Controller;

use App\Entity\Division;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;


class DivisionController extends AbstractController
{
    private $em;
    /**
     *  @param $em
     */

     public function __construct(EntityManagerInterface $em)
     {
        $this->em = $em;
     }


    #[Route('/division/insertar', name: 'insertar_division',methods: ['POST'])]
    public function insert(Request $request) {

        $data = json_decode($request->getContent(), true);

        $nombre = $data['nombre'] ?? null;
        $descripcion = $data['descripcion'] ?? null;
    
        if ($nombre === null || $descripcion === null) {
            return new JsonResponse(['error' => 'Invalid JSON payload'], 400);
        }
    

        $division = new Division(nombre: $nombre, descripcion: $descripcion);

        $this->em->persist($division);
        $this->em->flush();

        return new JsonResponse(['success'=> true]);
    }

    #[Route('/division/{id}', name: 'obtener_division', methods: ['GET'])]
    public function show($id) {
        $division = $this->em->getRepository(Division::class)->find($id);
        if(!$division){
            return new JsonResponse(['Error'=> "404"]);
        }

        return new JsonResponse(['division' => $division->serialize()]); 
    }

    #[Route('/division', name: 'obtener_division_todas', methods: ['GET'])]
    public function showAll(){
        $divisions = $this->em->getRepository(Division::class)->findAll();
        if (count($divisions) === 0) {
            return new JsonResponse([]);
        } else {
            $divisionData = [];
    
            foreach ($divisions as $division) {
                $divisionData[] = [
                    'nombre' => $division->getNombre(),
                    'descripcion' => $division->getDescripcion(),
                    'id' => $division->getId()
                ];
            }
    
            return new JsonResponse(['divisiones' => $divisionData]);
        }
    }

    #[Route('/division/{id}/actualizar', name: 'actualizar_division', methods: ['PUT'])]
    public function update(Request $request, $id)
    {
        $data = json_decode($request->getContent(), true);

        $nombre = $data['nombre'] ?? null;
        $descripcion = $data['descripcion'] ?? null;

        if ($nombre == null || $descripcion === null){
            return new JsonResponse(['error' => 'Invalid JSON payload'], 400);
        }

        $division = $this->em->getRepository(Division::class)->find($id);

        if (!$division) {
            return new Response('Division not found', 404);
        }

        $division->setNombre($nombre);
        $division->setDescripcion($descripcion);

        $this->em->flush();

        return new JsonResponse(['success' => true]);
    }

    #[Route('/division/{id}/eliminar', name: 'eliminar_division', methods: ['DELETE'])]
    public function delete($id) {
        $division = $this->em->getRepository(Division::class)->find($id);
        $this->em->remove($division);
        $this->em->flush();

        return new JsonResponse(['success'=>true]);
    }

}
