<?php

namespace App\Entity;

use App\Repository\ObraRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObraRepository::class)]
class Obra
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[ORM\Column(length: 255)]
    private ?string $autor = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 255)]
    private ?string $clasificacion = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_publicacion = null;

    #[ORM\OneToMany(mappedBy: 'work_id', targetEntity: Documentacion::class)]
    private Collection $documentacions;

    public function __construct()
    {
        $this->documentacions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(string $autor): self
    {
        $this->autor = $autor;

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

    public function getClasificacion(): ?string
    {
        return $this->clasificacion;
    }

    public function setClasificacion(string $clasificacion): self
    {
        $this->clasificacion = $clasificacion;

        return $this;
    }

    public function getFechaPublicacion(): ?\DateTimeInterface
    {
        return $this->fecha_publicacion;
    }

    public function setFechaPublicacion(\DateTimeInterface $fecha_publicacion): self
    {
        $this->fecha_publicacion = $fecha_publicacion;

        return $this;
    }

    /**
     * @return Collection<int, Documentacion>
     */
    public function getDocumentacions(): Collection
    {
        return $this->documentacions;
    }

    public function addDocumentacion(Documentacion $documentacion): self
    {
        if (!$this->documentacions->contains($documentacion)) {
            $this->documentacions->add($documentacion);
            $documentacion->setWorkId($this);
        }

        return $this;
    }

    public function removeDocumentacion(Documentacion $documentacion): self
    {
        if ($this->documentacions->removeElement($documentacion)) {
            // set the owning side to null (unless already changed)
            if ($documentacion->getWorkId() === $this) {
                $documentacion->setWorkId(null);
            }
        }

        return $this;
    }
}
