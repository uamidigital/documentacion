<?php

namespace App\Entity;

use App\Repository\DivisionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DivisionRepository::class)]
class Division
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descripcion = null;

    #[ORM\OneToMany(mappedBy: 'division_id', targetEntity: Departamento::class)]
    private Collection $departamentos;

    public function serialize(){
        return [
            'id'=>$this->id,
            'nombre'=>$this->nombre,
            'descripcion'=>$this->descripcion,
        ];
    }

    public function __construct($nombre = null, $descripcion = null){
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
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

    /**
     * @return Collection<int, Departamento>
     */
    public function getDepartamentos(): Collection
    {
        return $this->departamentos;
    }

    public function addDepartamento(Departamento $departamento): self
    {
        if (!$this->departamentos->contains($departamento)) {
            $this->departamentos->add($departamento);
            $departamento->setDivisionId($this);
        }

        return $this;
    }

    public function removeDepartamento(Departamento $departamento): self
    {
        if ($this->departamentos->removeElement($departamento)) {
            // set the owning side to null (unless already changed)
            if ($departamento->getDivisionId() === $this) {
                $departamento->setDivisionId(null);
            }
        }

        return $this;
    }
}
