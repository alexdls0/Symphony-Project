<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriaRepository")
 * @UniqueEntity(fields={"titulo"}, message="This category already exists")
 */
class Categoria extends Contenido
{
    
    /**
     * @ORM\Column(type="string", length=64, unique=true)
     */
    private $titulo;
    
    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }
    
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Video", inversedBy="categorias")
     */
    private $videos;

    public function __construct()
    {
        $this->videos = new ArrayCollection();
    }

    /**
     * @return Collection|Video[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Video $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
        }

        return $this;
    }
    
    
    public function __toString() {
        $return = null;
        if (!empty($this)) {
            $return = $this->getTitulo();
        }
        return $return;
    }
}
