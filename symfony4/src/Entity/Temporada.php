<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TemporadaRepository")
 * @ORM\Table(
 *      name="temporada",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"orden", "serie_id"})}
 * )
 * @UniqueEntity(
 *      fields={"orden","serie"},
 *      message="Order cant repeat in the same show"
 * )
 */
class Temporada extends Contenido
{
    
    /**
     * @ORM\Column(type="string", length=64)
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
     * @ORM\Column(type="smallint")
     */
    private $orden;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Video", mappedBy="temporada")
     */
    private $videos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Grupo", inversedBy="temporadas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $serie;

    public function __construct()
    {
        $this->videos = new ArrayCollection();
    }

    public function getOrden(): ?int
    {
        return $this->orden;
    }

    public function setOrden(int $orden): self
    {
        $this->orden = $orden;

        return $this;
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
            $video->setTemporada($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
            // set the owning side to null (unless already changed)
            if ($video->getTemporada() === $this) {
                $video->setTemporada(null);
            }
        }

        return $this;
    }

    public function getSerie(): ?Grupo
    {
        return $this->serie;
    }

    public function setSerie(?Grupo $serie): self
    {
        $this->serie = $serie;

        return $this;
    }
    
    /*
    
    public function getAnteriorCapitulo(Video $video)
    {
        $actual_id = $video->getId();
        if ($actual_id > 1) {
            $anterior_id = $actual_id--;
            foreach ($this->getVideos() as $video) {
                if ($video->getId() === $anterior_id) {
                    return $video;
                }
            }
            
        }
        
        return null;
    }
    
    public function getSiguienteCapitulo(Video $video)
    {
        $actual_id = $video->getId();
        if ($actual_id > 1) {
            $siguiente_id = $actual_id++;
            foreach ($this->getVideos() as $video) {
                if ($video->getId() === $siguiente_id) {
                    return $video;
                }
            }
            
        }
        
        return null;
    }
    */
    
    public function __toString(){
        return $this->titulo;
    }
}
