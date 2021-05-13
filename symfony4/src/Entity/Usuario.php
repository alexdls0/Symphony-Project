<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use \DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuarioRepository")
 * @UniqueEntity(fields={"apodo"}, message="This username already exists")
 * @UniqueEntity(fields={"correo"}, message="This email already exists")
 */
class Usuario implements UserInterface
{
    
    //Languages
    /*
    const LOCALE = [
        'English' => 'en',
        'Español' => 'es'
    ];
    */
    
    /**
     * CUSTOM ROLE SYSTEM =====
     */
    const ROLES = [
        0 => [
            'name' => 'User',
            'role' => 'ROLE_USER'
        ],
        1 => [
            'name' => 'Admin',
            'role' => 'ROLE_ADMIN'
        ]
    ];
    
    public function getRoles() {
        $role = [self::ROLES[$this->getType()]['role']];
        return $role;
    }
    
    /**
     * @ORM\Column(type="boolean", nullable=false, precision=1, options={"default" : 0})
     */
    private $type;
    
    function getType() {
        return $this->type;
    }

    function setType($type) {
        $this->type = $type;
    }
    
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $apodo;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $correo;
    
    /**
     * @ORM\Column(type="boolean", nullable=false, precision=1, options={"default" : 0})
     */
    private $activo = 0;
    
    /**
     * @var string
     * @ORM\Column(name="locale", type="string", length=4, nullable=true)
     */
    private $locale = 'en';

    /**
     * @ORM\Column(type="datetime")
     */
    private $fechaalta;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $fechapremium;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $fechanac;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $videolang;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Video", inversedBy="fans")
     */
    private $favoritos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pago", mappedBy="cuentausuario")
     */
    private $pagos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EstadoVideo", mappedBy="usuario", orphanRemoval=true)
     */
    private $estadovideos;


    public function __construct()
    {
        $this->fechanac = new DateTime();
        $this->fechapremium = new DateTime();
        $this->fechaalta = new DateTime();
        $this->favoritos = new ArrayCollection();
        $this->pagos = new ArrayCollection();
        $this->estadovideos = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApodo(): ?string
    {
        return $this->apodo;
    }

    public function setApodo(string $apodo): self
    {
        $this->apodo = $apodo;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->apodo;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

    public function getFechaalta(): ?\DateTimeInterface
    {
        return $this->fechaalta;
    }

    public function setFechaalta(\DateTimeInterface $fechaalta): self
    {
        $this->fechaalta = $fechaalta;

        return $this;
    }

    public function getFechapremium(): ?\DateTimeInterface
    {
        return $this->fechapremium;
    }

    public function setFechapremium(\DateTimeInterface $fechapremium): self
    {
        $this->fechapremium = $fechapremium;

        return $this;
    }

    public function getFechanac(): ?\DateTimeInterface
    {
        return $this->fechanac;
    }

    public function setFechanac(\DateTimeInterface $fechanac): self
    {
        $this->fechanac = $fechanac;

        return $this;
    }

    public function getVideolang(): ?string
    {
        return $this->videolang;
    }

    public function setVideolang(?string $videolang): self
    {
        $this->videolang = $videolang;

        return $this;
    }
    
    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Usuario
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }
    
    public function __toString(){
        return strval($this->id);
    }
    
    function getLocale() {
        return $this->locale;
    }

    function setLocale($locale) {
        $this->locale = $locale;
    }

    /**
     * @return Collection|Video[]
     */
    public function getFavoritos(): Collection
    {
        return $this->favoritos;
    }

    public function addFavorito(Video $favorito): self
    {
        if (!$this->favoritos->contains($favorito)) {
            $this->favoritos[] = $favorito;
        }

        return $this;
    }

    public function removeFavorito(Video $favorito): self
    {
        if ($this->favoritos->contains($favorito)) {
            $this->favoritos->removeElement($favorito);
        }

        return $this;
    }

    /**
     * @return Collection|Pago[]
     */
    public function getPagos(): Collection
    {
        return $this->pagos;
    }

    public function addPago(Pago $pago): self
    {
        if (!$this->pagos->contains($pago)) {
            $this->pagos[] = $pago;
            $pago->setCuentausuario($this);
        }

        return $this;
    }

    public function removePago(Pago $pago): self
    {
        if ($this->pagos->contains($pago)) {
            $this->pagos->removeElement($pago);
            // set the owning side to null (unless already changed)
            if ($pago->getCuentausuario() === $this) {
                $pago->setCuentausuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|EstadoVideo[]
     */
    public function getEstadovideos(): Collection
    {
        return $this->estadovideos;
    }

    public function addEstadovideo(EstadoVideo $estadovideo): self
    {
        if (!$this->estadovideos->contains($estadovideo)) {
            $this->estadovideos[] = $estadovideo;
            $estadovideo->setUsuario($this);
        }

        return $this;
    }

    public function removeEstadovideo(EstadoVideo $estadovideo): self
    {
        if ($this->estadovideos->contains($estadovideo)) {
            $this->estadovideos->removeElement($estadovideo);
            // set the owning side to null (unless already changed)
            if ($estadovideo->getUsuario() === $this) {
                $estadovideo->setUsuario(null);
            }
        }

        return $this;
    }

}
