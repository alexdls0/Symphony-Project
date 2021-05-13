<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GrupoRepository")
 * @ORM\Table(
 *      name="grupo",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"titulo", "tipo"})}
 * )
 * @UniqueEntity(
 *      fields={"titulo","tipo"},
 *      message="The same name cant exist for the same type"
 * )
 */
class Grupo extends Contenido
{
    
    /**
     * Easy type system =====
     */
    const TYPES = [
        0 => 'saga',
        1 => 'serie'
    ];
    /**
     * Route per type =====
     */
    const ROUTES = [
        0 => 'capsule_browse_saga',
        1 => 'capsule_browse_show'
    ];
    
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
     * @ORM\Column(type="boolean", nullable=false, precision=1, options={"default" : 0})
     */
    private $tipo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Temporada", mappedBy="serie", orphanRemoval=true)
     */
    private $temporadas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Video", mappedBy="grupo")
     */
    private $videos;

    public function __construct()
    {
        $this->temporadas = new ArrayCollection();
        $this->videos = new ArrayCollection();
    }
    
    public function getTipoString() {
        $tipo = [self::TYPES[$this->getTipo()]];
        return $tipo;
    }
    
    public function getRoute() {
        $route = self::ROUTES[$this->getTipo()];
        return $route;
    }
    
    public function getthumbsrc() {
        $thumbsrc = null;
        if ($this->videos[0]) {
            $thumbsrc = $this->videos[0] -> getThumbsrc();
            if ($thumbsrc !== '' || $thumbsrc !== null) {
                return $thumbsrc;
            }
        } else {
            return null;
        }
    }
    
    public function isgrupo() {
        return $this;
    }
    
    function getTipo() {
        return $this->tipo;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    /**
     * @return Collection|Temporada[]
     */
    public function getTemporadas(): Collection
    {
        return $this->temporadas;
    }

    public function addTemporada(Temporada $temporada): self
    {
        if (!$this->temporadas->contains($temporada)) {
            $this->temporadas[] = $temporada;
            $temporada->setSerie($this);
        }

        return $this;
    }

    public function removeTemporada(Temporada $temporada): self
    {
        if ($this->temporadas->contains($temporada)) {
            $this->temporadas->removeElement($temporada);
            // set the owning side to null (unless already changed)
            if ($temporada->getSerie() === $this) {
                $temporada->setSerie(null);
            }
        }

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
            $video->setGrupo($this);
        }

        return $this;
    }

    public function removeVideo(Video $video): self
    {
        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
            // set the owning side to null (unless already changed)
            if ($video->getGrupo() === $this) {
                $video->setGrupo(null);
            }
        }

        return $this;
    }
    
    public function __toString(){
        return $this->titulo;
    }
    
}
