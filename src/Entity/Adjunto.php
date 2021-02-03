<?php

namespace App\Entity;

use App\Repository\AdjuntoRepository;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdjuntoRepository::class)
 */
class Adjunto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=task::class, inversedBy="adjunto")
     * @ORM\JoinColumn(nullable=false)
     */
    private $adjunto;

    /**
     * @var \Fichero|null
     *
     * @ORM\Column(name="fichero", type="string", nullable=true)
     */
    private $fichero;    
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdjunto(): ?task
    {
        return $this->adjunto;
    }

    public function setAdjunto(?task $adjunto): self
    {
        $this->adjunto = $adjunto;

        return $this;
    }


    public function getFichero(): ?string
    {
        return $this->fichero;
    }

    public function setFichero(?string $fichero): self
    {
        $this->fichero = $fichero;

        return $this;
    }

}
