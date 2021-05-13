<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductorRepository")
 * @UniqueEntity(fields={"titulo"}, message="This producer already exists")
 */
class Productor extends Contenido
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thumbsrc;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Video", mappedBy="productor")
     */
    private $videos;

    public function __construct()
    {
        $this->videos = new ArrayCollection();
    }

    public function getThumbsrc(): ?string
    {
        return $this->thumbsrc;
    }

    public function setThumbsrc(?string $thumbsrc): self
    {
        $this->thumbsrc = $thumbsrc;

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
            $video->setProductor($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
            // set the owning side to null (unless already changed)
            if ($video->getProductor() === $this) {
                $video->setProductor(null);
            }
        }

        return $this;
    }
    
    public function __toString(){
        return $this->titulo;
    }
}
