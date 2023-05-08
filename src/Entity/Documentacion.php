<?php

namespace App\Entity;

use App\Repository\DocumentacionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DocumentacionRepository::class)]
class Documentacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre_archivo = null;

    #[ORM\Column(length: 255)]
    private ?string $path = null;

    #[ORM\Column(length: 255)]
    private ?string $tipo = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_emision = null;

    #[ORM\ManyToOne(inversedBy: 'documentacions')]
    private ?Usuario $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'documentacions')]
    private ?Obra $work_id = null;

    #[ORM\OneToMany(mappedBy: 'document_id', targetEntity: Version::class)]
    private Collection $versions;

    public function __construct()
    {
        $this->versions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreArchivo(): ?string
    {
        return $this->nombre_archivo;
    }

    public function setNombreArchivo(string $nombre_archivo): self
    {
        $this->nombre_archivo = $nombre_archivo;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getFechaEmision(): ?\DateTimeInterface
    {
        return $this->fecha_emision;
    }

    public function setFechaEmision(\DateTimeInterface $fecha_emision): self
    {
        $this->fecha_emision = $fecha_emision;

        return $this;
    }

    public function getUserId(): ?Usuario
    {
        return $this->user_id;
    }

    public function setUserId(?Usuario $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getWorkId(): ?Obra
    {
        return $this->work_id;
    }

    public function setWorkId(?Obra $work_id): self
    {
        $this->work_id = $work_id;

        return $this;
    }

    /**
     * @return Collection<int, Version>
     */
    public function getVersions(): Collection
    {
        return $this->versions;
    }

    public function addVersion(Version $version): self
    {
        if (!$this->versions->contains($version)) {
            $this->versions->add($version);
            $version->setDocumentId($this);
        }

        return $this;
    }

    public function removeVersion(Version $version): self
    {
        if ($this->versions->removeElement($version)) {
            // set the owning side to null (unless already changed)
            if ($version->getDocumentId() === $this) {
                $version->setDocumentId(null);
            }
        }

        return $this;
    }
}
