<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EstadoVideoRepository")
 * @ORM\Table(
 *      name="estado_video",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"usuario_id", "video_id"})}
 * )
 * @UniqueEntity(
 *      fields={"usuario","video"},
 *      message="A user cant store the same video twice"
 * )
 */
class EstadoVideo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="estadovideos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\Column(type="boolean", nullable=false, precision=1, options={"default" : 0})
     */
    private $completo;

    /**
     * @ORM\Column(type="integer", length=255, options={"default" : 0})
     */
    private $tiempo;

    /**
     * @ORM\Column(type="integer", length=255, options={"default" : 0})
     */
    private $tiempototal;

    /**
     * @ORM\Column(type="smallint", options={"default" : 0})
     */
    private $porcentaje;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $modificado;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Video", inversedBy="estadoVideos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $video;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getCompleto(): ?bool
    {
        return $this->completo;
    }

    public function setCompleto(bool $completo): self
    {
        $this->completo = $completo;

        return $this;
    }

    public function getTiempo(): ?string
    {
        return $this->tiempo;
    }

    public function setTiempo(string $tiempo): self
    {
        $this->tiempo = $tiempo;

        return $this;
    }

    public function getTiempototal(): ?string
    {
        return $this->tiempototal;
    }

    public function setTiempototal(string $tiempototal): self
    {
        $this->tiempototal = $tiempototal;

        return $this;
    }

    public function getPorcentaje(): ?int
    {
        return $this->porcentaje;
    }

    public function setPorcentaje(int $porcentaje): self
    {
        $this->porcentaje = $porcentaje;

        return $this;
    }

    public function getVideo(): ?Video
    {
        return $this->video;
    }

    public function setVideo(?Video $video): self
    {
        $this->video = $video;

        return $this;
    }
    
    public function getModificado(): ?\DateTimeInterface
    {
        return $this->modificado;
    }

    public function setModificado(\DateTimeInterface $modificado): self
    {
        $this->modificado = $modificado;

        return $this;
    }
    
    public function __toString(){
        return (string)$this->id;
    }

}
