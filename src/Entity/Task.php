<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="tasks", indexes={@ORM\Index(name="fk_task_user", columns={"user_id"})})
 * @ORM\Entity
 */
class Task
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=true)
     */
    private $content;

    /**
     * @var string|null
     *
     * @ORM\Column(name="priority", type="string", length=20, nullable=true)
     */
    private $priority;

    /**
     * @var int|null
     *
     * @ORM\Column(name="hours", type="integer", nullable=true)
     */
    private $hours;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="tasks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $user;

    /**
     * @var \Estado|null
     *
     * @ORM\Column(name="estado", type="string", nullable=true)
     */
    private $estado;    

    /**
     * @var \User_Id|null
     *
     * @ORM\Column(name="user_id", type="string", nullable=true)
     */
    private $user_id;

    /**
     * @ORM\OneToMany(targetEntity=Adjunto::class, mappedBy="adjunto")
     */
    private $adjunto;

    public function __construct()
    {
        $this->adjunto = new ArrayCollection();
    }        

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPriority(): ?string
    {
        return $this->priority;
    }

    public function setPriority(?string $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getHours(): ?int
    {
        return $this->hours;
    }

    public function setHours(?int $hours): self
    {
        $this->hours = $hours;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }





    public function getUser_Id(): ?string
    {
        return $this->user_id;
    }

    public function setUser_Id(?string $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return Collection|Adjunto[]
     */
    public function getAdjunto(): Collection
    {
        return $this->adjunto;
    }
    public function setAdjunto(Adjunto $adjunto): self
    {
        $this->adjunto = $adjunto;

        return $this;
    }
    public function addAdjunto(Adjunto $adjunto): self
    {
        if (!$this->adjunto->contains($adjunto)) {
            $this->adjunto[] = $adjunto;
            $adjunto->setAdjunto($this);
        }

        return $this;
    }

    public function removeAdjunto(Adjunto $adjunto): self
    {
        if ($this->adjunto->contains($adjunto)) {
            $this->adjunto->removeElement($adjunto);
            // set the owning side to null (unless already changed)
            if ($adjunto->getAdjunto() === $this) {
                $adjunto->setAdjunto(null);
            }
        }

        return $this;
    }



}