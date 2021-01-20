<?php

namespace App\Entity;

use App\Repository\AdjuntosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdjuntosRepository::class)
 */
class Adjuntos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @var \fichero|null
     *
     * @ORM\Column(name="fichero", type="string", nullable=true)
     */
    private $fichero;

    /**
     * @ORM\ManyToOne(targetEntity=task::class, inversedBy="adjuntos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $adjuntos;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setid(?string $id): self
    {
        $this->Id = $id;

        return $this;
    }   
    public function getAdjuntos_id(): ?task
    {
        return $this->adjuntos_id;
    }

    public function setAdjuntos_id(?task $adjuntos_id): self
    {
        $this->adjuntos_id = $adjuntos_id;

        return $this;
    }

    public function getFichero(): ?string
    {
        return $this->fichero;
    }

    public function setFichero(?string $fichero): self
    {
        $this->Fichero = $fichero;

        return $this;
    }

}
