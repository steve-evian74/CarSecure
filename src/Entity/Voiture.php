<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoitureRepository")
 */
class Voiture
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $immatriculation;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $modele;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $finition;

    /**
     * @ORM\Column(type="date")
     */
    private $dateAchat;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $energie;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $cvFiscale;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $cvDin;

    /**
     * @ORM\Column(type="boolean")
     */
    private $vente;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="fkVoiture")
     */
    private $fkUser;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CarnetEntretien", mappedBy="fkVoiture")
     */
    private $fkCarnetEntretien;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UploadImage", mappedBy="fkVoitureUpload")
     */
    private $fkUploadVoitureImage;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $kilometre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;





    public function __construct()
    {
        $this->fkCarnetEntretien = new ArrayCollection();
        $this->fkUploadVoitureImage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): self
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getFinition(): ?string
    {
        return $this->finition;
    }

    public function setFinition(string $finition): self
    {
        $this->finition = $finition;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->dateAchat;
    }

    public function setDateAchat(\DateTimeInterface $dateAchat): self
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    public function getEnergie(): ?string
    {
        return $this->energie;
    }

    public function setEnergie(string $energie): self
    {
        $this->energie = $energie;

        return $this;
    }

    public function getCvFiscale(): ?string
    {
        return $this->cvFiscale;
    }

    public function setCvFiscale(string $cvFiscale): self
    {
        $this->cvFiscale = $cvFiscale;

        return $this;
    }

    public function getCvDin(): ?string
    {
        return $this->cvDin;
    }

    public function setCvDin(string $cvDin): self
    {
        $this->cvDin = $cvDin;

        return $this;
    }

    public function getVente(): ?bool
    {
        return $this->vente;
    }

    public function setVente(bool $vente): self
    {
        $this->vente = $vente;

        return $this;
    }

    public function getFkUser(): ?User
    {
        return $this->fkUser;
    }

    public function setFkUser(?User $fkUser): self
    {
        $this->fkUser = $fkUser;

        return $this;
    }

    /**
     * @return Collection|CarnetEntretien[]
     */
    public function getFkCarnetEntretien(): Collection
    {
        return $this->fkCarnetEntretien;
    }

    public function addFkCarnetEntretien(CarnetEntretien $fkCarnetEntretien): self
    {
        if (!$this->fkCarnetEntretien->contains($fkCarnetEntretien)) {
            $this->fkCarnetEntretien[] = $fkCarnetEntretien;
            $fkCarnetEntretien->setFkVoiture($this);
        }

        return $this;
    }

    public function removeFkCarnetEntretien(CarnetEntretien $fkCarnetEntretien): self
    {
        if ($this->fkCarnetEntretien->contains($fkCarnetEntretien)) {
            $this->fkCarnetEntretien->removeElement($fkCarnetEntretien);
            // set the owning side to null (unless already changed)
            if ($fkCarnetEntretien->getFkVoiture() === $this) {
                $fkCarnetEntretien->setFkVoiture(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UploadImage[]
     */
    public function getFkUploadVoitureImage(): Collection
    {
        return $this->fkUploadVoitureImage;
    }

    public function addFkUploadVoitureImage(UploadImage $fkUploadVoitureImage): self
    {
        if (!$this->fkUploadVoitureImage->contains($fkUploadVoitureImage)) {
            $this->fkUploadVoitureImage[] = $fkUploadVoitureImage;
            $fkUploadVoitureImage->setFkVoitureUpload($this);
        }

        return $this;
    }

    public function removeFkUploadVoitureImage(UploadImage $fkUploadVoitureImage): self
    {
        if ($this->fkUploadVoitureImage->contains($fkUploadVoitureImage)) {
            $this->fkUploadVoitureImage->removeElement($fkUploadVoitureImage);
            // set the owning side to null (unless already changed)
            if ($fkUploadVoitureImage->getFkVoitureUpload() === $this) {
                $fkUploadVoitureImage->setFkVoitureUpload(null);
            }
        }

        return $this;
    }

    public function getKilometre(): ?string
    {
        return $this->kilometre;
    }

    public function setKilometre(string $kilometre): self
    {
        $this->kilometre = $kilometre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

   

   
}
