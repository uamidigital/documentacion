<?php

namespace App\Controller;

use App\Entity\Departamento;
use App\Entity\Division;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class DepartamentoController extends AbstractController
{
    private $em;
    /**
     *  @param $em
     */

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    #[Route('/departamento', name: 'obtener_departamento_todos', methods: ['GET'])]
    public function showAll(){
        $departments = $this->em->getRepository(Departamento::class)->findAll();
        if(count($departments) === 0){
            return new JsonResponse([]);
        } else {
            $departamentoData = [];
            foreach($departments as $departamento) {
                $division = $this->em->getRepository(Division::class)->find($departamento->getDivisionId());
                $departamentoData[] = [
                    'nombre' => $departamento->getNombre(),
                    'descripcion' => $departamento->getDescripcion(),
                    'id' => $departamento->getId(),
                    'division' => [
                        'nombre'=>$division->getNombre(),
                    ]
                ];
            } 
            return new JsonResponse(['departamentos'=>$departamentoData]);
        }
    }

   #[Route('/departamento/division/{id}', name: 'obtener_departamento_division', methods: ['GET'])]
    public function showFilter($id){
        $division = $this->em->getRepository(Division::class)->findBy($id);
        
        if(!$division){
            return new JsonResponse(['Error' => "404"]);
        }
        return new JsonResponse(['departamento' => $departamento->serialize()]);
    }

    #[Route('/departamento/{id}', name: 'obtener_departamento', methods: ['GET'])]
    public function show($id){
        $departamento = $this->em->getRepository(Departamento::class)->find($id);
        if(!$departamento){
            return new JsonResponse(['Error'=>"404"]);
        }

        return new JsonResponse(['departamento' => $departamento->serialize()]);
    }
    

    #[Route('/departamento/insertar', name: 'insertar_departamento', methods: ['POST'])]
    public function insert(Request $request) {

        $data = json_decode($request->getContent(), true);

        $nombre = $data['nombre'] ?? null;
        $descripcion = $data['descripcion'] ?? null;
        $division = $data['division_id'] ?? null;

        if ($nombre == null || $descripcion === null || $division===null){
            return new JsonResponse(['error' => 'Invalid JSON payload'], 400);
        }
    
        $divisionEntity = $this->em->getRepository(Division::class)->find($division);
        $departamento = new Departamento(nombre: $nombre, descripcion: $descripcion, division_id: $divisionEntity);
        $this->em->persist($departamento);
        $this->em->flush();

        return new JsonResponse(['success'=>true]);
    }


    #[Route('/departamento/{id}/actualizar', name: 'actualizar_departamento', methods: ['PUT'])]
    public function update($id)
    {
        $departamento = $this->em->getRepository(Departamento::class)->find($id);
        $departamento->setNombre('Nuevo nombre');
        $departamento->setDescripcion('Nueva descripción');
        $this->em->flush();
        return new JsonResponse(['success' => true]);
    }

    #[Route('/departamento/{id}/eliminar', name: 'eliminar_departamento', methods: ['DELETE'])]
    public function delete($id)
    {
        $departamento = $this->em->getRepository(Departamento::class)->find($id);
        $this->em->remove($departamento);
        $this->em->flush();
        return new JsonResponse(['success' => true]);
    }


}