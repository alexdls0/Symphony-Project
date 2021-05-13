<?php

namespace App\Entity;

use \DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PagoRepository")
 */
class Pago
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $nombretitular;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $apellidotitular;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $empresatarjeta;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $numerotarjeta;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $cvv;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuario", inversedBy="pagos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cuentausuario;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $importe;
    
    public function __construct() {
        $this->fecha = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombretitular(): ?string
    {
        return $this->nombretitular;
    }

    public function setNombretitular(string $nombretitular): self
    {
        $this->nombretitular = $nombretitular;

        return $this;
    }

    public function getApellidotitular(): ?string
    {
        return $this->apellidotitular;
    }

    public function setApellidotitular(string $apellidotitular): self
    {
        $this->apellidotitular = $apellidotitular;

        return $this;
    }

    public function getEmpresatarjeta(): ?string
    {
        return $this->empresatarjeta;
    }

    public function setEmpresatarjeta(?string $empresatarjeta): self
    {
        $this->empresatarjeta = $empresatarjeta;

        return $this;
    }

    public function getNumerotarjeta(): ?int
    {
        return $this->numerotarjeta;
    }
    
    public function getNumerotarjetaMask(): ?string
    {
        $numerotarjeta_mask = 'XXXX-XXXX-XXXX-'.substr( $this->numerotarjeta, -4 );
        return $numerotarjeta_mask;
    }

    public function setNumerotarjeta(int $numerotarjeta): self
    {
        $this->numerotarjeta = $numerotarjeta;

        return $this;
    }

    public function getCvv()
    {
        return $this->cvv;
    }

    public function setCvv($cvv): self
    {
        $this->cvv = $cvv;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getCuentausuario(): ?Usuario
    {
        return $this->cuentausuario;
    }

    public function setCuentausuario(?Usuario $cuentausuario): self
    {
        $this->cuentausuario = $cuentausuario;

        return $this;
    }

    public function getImporte(): ?string
    {
        return $this->importe;
    }

    public function setImporte(string $importe): self
    {
        $this->importe = $importe;

        return $this;
    }
    public function __toString(){
        return (string)$this->id;
    }

}
