<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntrepriseRepository")
 */
class Entreprise
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\Length(
     *      min = 4,
     *      minMessage = "Le nom de l'entreprise doit faire au moins {{ limit }} carctères"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=150)
     * @Assert\NotBlank
     */
    private $activite;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Regex(
     *          pattern="#^[1-9]([0-9])?[0-9]?( bis|bis)? #", 
     *          message="Le numéro de rue semble incorrect"
     * )
     * @Assert\Regex(
     *          pattern="#avenue|rue|route|boulevard|place|allée|impasse|voie#", 
     *          message="Le type de route/voie semble incorrecte"
     * )
     * @Assert\Regex(
     *          pattern=" # [0-9]{5} #", 
     *          message="Il semble y avoir un problème avec le code postal"
     * )
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     * @Assert\Url
     */
    private $siteWeb;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stage", mappedBy="nomEntreprise")
     */
    private $stages;

    public function __construct()
    {
        $this->stages = new ArrayCollection();
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

    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(string $activite): self
    {
        $this->activite = $activite;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getSiteWeb(): ?string
    {
        return $this->siteWeb;
    }

    public function setSiteWeb(?string $siteWeb): self
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    /**
     * @return Collection|Stage[]
     */
    public function getStages(): Collection
    {
        return $this->stages;
    }

    public function addStage(Stage $stage): self
    {
        if (!$this->stages->contains($stage)) {
            $this->stages[] = $stage;
            $stage->setNomEntreprise($this);
        }

        return $this;
    }

    public function removeStage(Stage $stage): self
    {
        if ($this->stages->contains($stage)) {
            $this->stages->removeElement($stage);
            // set the owning side to null (unless already changed)
            if ($stage->getNomEntreprise() === $this) {
                $stage->setNomEntreprise(null);
            }
        }

        return $this;
    }

    public function __toString() 
    {
        return $this->getNom();
    }
}
