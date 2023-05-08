<?php

namespace App\Entity;

use App\Repository\VersionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VersionRepository::class)]
class Version
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $notas = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha_actualizado = null;

    #[ORM\ManyToOne(inversedBy: 'versions')]
    private ?Documentacion $document_id = null;

    #[ORM\ManyToOne(inversedBy: 'versions')]
    private ?Usuario $user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNotas(): ?string
    {
        return $this->notas;
    }

    public function setNotas(string $notas): self
    {
        $this->notas = $notas;

        return $this;
    }

    public function getFechaActualizado(): ?\DateTimeInterface
    {
        return $this->fecha_actualizado;
    }

    public function setFechaActualizado(\DateTimeInterface $fecha_actualizado): self
    {
        $this->fecha_actualizado = $fecha_actualizado;

        return $this;
    }

    public function getDocumentId(): ?Documentacion
    {
        return $this->document_id;
    }

    public function setDocumentId(?Documentacion $document_id): self
    {
        $this->document_id = $document_id;

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
}
