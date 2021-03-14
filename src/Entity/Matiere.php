<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MatiereRepository::class)
 */
class Matiere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateFin;

    /**
     * @ORM\OneToMany(targetEntity=Intervenant::class, mappedBy="matiere", orphanRemoval=true)
     */
    private $intervenant;

    /**
     * @ORM\ManyToOne(targetEntity=classes::class, inversedBy="matieres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classe;

    public function __construct()
    {
        $this->intervenant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * @return Collection|Intervenant[]
     */
    public function getIntervenant(): Collection
    {
        return $this->intervenant;
    }

    public function addIntervenant(Intervenant $intervenant): self
    {
        if (!$this->intervenant->contains($intervenant)) {
            $this->intervenant[] = $intervenant;
            $intervenant->setMatiere($this);
        }

        return $this;
    }

    public function removeIntervenant(Intervenant $intervenant): self
    {
        if ($this->intervenant->removeElement($intervenant)) {
            // set the owning side to null (unless already changed)
            if ($intervenant->getMatiere() === $this) {
                $intervenant->setMatiere(null);
            }
        }

        return $this;
    }

    public function getClasse(): ?classes
    {
        return $this->classe;
    }

    public function setClasse(?classes $classe): self
    {
        $this->classe = $classe;

        return $this;
    }
}
