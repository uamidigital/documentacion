<?php

namespace App\Entity;

use App\Repository\DepartamentoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartamentoRepository::class)]
class Departamento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descripcion = null;

    #[ORM\ManyToOne(inversedBy: 'departamentos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Division $division_id = null;

    public function serialize(){
        return [
            'id'=>$this->id,
            'nombre'=>$this->nombre,
            'descripcion'=>$this->descripcion,
            'division'=>$this->division_id
        ];
    }

    public function __construct($nombre = null, $descripcion = null, $division_id = null){
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->division_id = $division_id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getDivisionId(): ?Division
    {
        return $this->division_id;
    }

    public function setDivisionId(?Division $division_id): self
    {
        $this->division_id = $division_id;

        return $this;
    }
}
