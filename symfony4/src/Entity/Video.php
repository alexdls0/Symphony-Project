<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use \DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VideoRepository")
 */
class Video extends Contenido
{
    
    /**
     * CUSTOM TYPE SYSTEM =====
     */
    const TYPES = [
        0 => 'pelicula',
        1 => 'capitulo'
    ];
    
    public function getTipoString() {
        $tipo = [self::TYPES[$this->getTipo()]];
        return $tipo;
    }
    
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
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $src;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thumbsrc;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $premium;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $edad;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $pais;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaonline;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fecharodada;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Director", inversedBy="videos")
     * @ORM\JoinColumn(name="director_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $director;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Productor", inversedBy="videos")
     * @ORM\JoinColumn(name="productor_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $productor;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Categoria", mappedBy="videos")
     */
    private $categorias;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Temporada", inversedBy="videos")
     * @ORM\JoinColumn(name="temporada_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $temporada;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Grupo", inversedBy="videos")
     * @ORM\JoinColumn(name="grupo_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $grupo;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Usuario", mappedBy="favoritos")
     */
    private $fans;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $terminoomdb;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EstadoVideo", mappedBy="video", orphanRemoval=true)
     */
    private $estadoVideos;

    public function __construct()
    {
        $this->categorias = new ArrayCollection();
        $this->fans = new ArrayCollection();
        $this->fechaonline = new DateTime();
        $this->fecharodada = new DateTime();
        $this->estadoVideos = new ArrayCollection();
    }
    
    function getTipo() {
        return $this->tipo;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getSrc(): ?string
    {
        return $this->src;
    }

    public function setSrc(?string $src): self
    {
        $this->src = $src;

        return $this;
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
     * If the video does not have a OMDB term
     * specified, $titulo will be url encoded 
     * to do the request to OMDB API
     */
    public function getTerminoomdb(): ?string
    {   
        $termino = $this->terminoomdb;
        if ( $termino === '' || null === $termino ) {
            $termino = rawurlencode( 
                $this->temporada ? 
                $this->getGrupo()->getTitulo() : 
                $this->getTitulo()
            );
        }
        return $termino;
    }

    public function setTerminoomdb(?string $t): self
    {
        $this->terminoomdb = $t;

        return $this;
    }

    public function getPremium(): ?bool
    {
        return $this->premium;
    }

    public function setPremium(?bool $premium): self
    {
        $this->premium = $premium;

        return $this;
    }

    public function getEdad(): ?int
    {
        return $this->edad;
    }

    public function setEdad(?int $edad): self
    {
        $this->edad = $edad;

        return $this;
    }

    public function getPais(): ?string
    {
        return $this->pais;
    }

    public function setPais(?string $pais): self
    {
        $this->pais = $pais;

        return $this;
    }

    public function getFechaonline(): ?\DateTimeInterface
    {
        return $this->fechaonline;
    }
    
    public function getFechaonlineString()
    {
        return $this->fechaonline->format('F j, Y');
    }

    public function setFechaonline(\DateTimeInterface $fechaonline): self
    {
        $this->fechaonline = $fechaonline;

        return $this;
    }

    public function getFecharodada(): ?\DateTimeInterface
    {
        return $this->fecharodada;
    }
    
    public function getFecharodadaString()
    {
        return $this->fecharodada->format('F j, Y');
    }

    public function setFecharodada(?\DateTimeInterface $fecharodada): self
    {
        $this->fecharodada = $fecharodada;

        return $this;
    }

    public function getDirector(): ?Director
    {
        return $this->director;
    }

    public function setDirector(?Director $director): self
    {
        $this->director = $director;

        return $this;
    }

    public function getProductor(): ?Productor
    {
        return $this->productor;
    }

    public function setProductor(?Productor $productor): self
    {
        $this->productor = $productor;

        return $this;
    }

    /**
     * @return Collection|Categoria[]
     */
    public function getCategorias(): Collection
    {
        return $this->categorias;
    }

    public function addCategoria(Categoria $categoria): self
    {
        if (!$this->categorias->contains($categoria)) {
            $this->categorias[] = $categoria;
            $categoria->addVideo($this);
        }

        return $this;
    }

    public function removeCategoria(Categoria $categoria): self
    {
        if ($this->categorias->contains($categoria)) {
            $this->categorias->removeElement($categoria);
            $categoria->removeVideo($this);
        }

        return $this;
    }

    public function getTemporada(): ?Temporada
    {
        return $this->temporada;
    }

    public function setTemporada(?Temporada $temporada): self
    {
        $this->temporada = $temporada;

        return $this;
    }

    public function getGrupo(): ?Grupo
    {
        return $this->grupo;
    }

    public function setGrupo(?Grupo $grupo): self
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * @return Collection|Usuario[]
     */
    public function getFans(): Collection
    {
        return $this->fans;
    }

    public function addFan(Usuario $fan): self
    {
        if (!$this->fans->contains($fan)) {
            $this->fans[] = $fan;
            $fan->addFavorito($this);
        }

        return $this;
    }

    public function removeFan(Usuario $fan): self
    {
        if ($this->fans->contains($fan)) {
            $this->fans->removeElement($fan);
            $fan->removeFavorito($this);
        }

        return $this;
    }

    /**
     * @return Collection|EstadoVideo[]
     */
    public function getEstadoVideos(): Collection
    {
        return $this->estadoVideos;
    }

    public function addEstadoVideo(EstadoVideo $estadoVideo): self
    {
        if (!$this->estadoVideos->contains($estadoVideo)) {
            $this->estadoVideos[] = $estadoVideo;
            $estadoVideo->setVideo($this);
        }

        return $this;
    }

    public function removeEstadoVideo(EstadoVideo $estadoVideo): self
    {
        if ($this->estadoVideos->contains($estadoVideo)) {
            $this->estadoVideos->removeElement($estadoVideo);
            // set the owning side to null (unless already changed)
            if ($estadoVideo->getVideo() === $this) {
                $estadoVideo->setVideo(null);
            }
        }

        return $this;
    }
    
    public function __toString(){
        return $this->titulo;
    }
    
}
