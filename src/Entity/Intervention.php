<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InterventionRepository")
 */
class Intervention
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieIntervention", inversedBy="fkIntervention")
     */
    private $FkCategorieIntervention;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CarnetEntretien", mappedBy="fkIntervention")
     */
    private $fkCarnetEntretien;

    public function __construct()
    {
        $this->fkCarnetEntretien = new ArrayCollection();
    }

   


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getFkCategorieIntervention(): ?CategorieIntervention
    {
        return $this->FkCategorieIntervention;
    }

    public function setFkCategorieIntervention(?CategorieIntervention $FkCategorieIntervention): self
    {
        $this->FkCategorieIntervention = $FkCategorieIntervention;

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
            $fkCarnetEntretien->setFkIntervention($this);
        }

        return $this;
    }

    public function removeFkCarnetEntretien(CarnetEntretien $fkCarnetEntretien): self
    {
        if ($this->fkCarnetEntretien->contains($fkCarnetEntretien)) {
            $this->fkCarnetEntretien->removeElement($fkCarnetEntretien);
            // set the owning side to null (unless already changed)
            if ($fkCarnetEntretien->getFkIntervention() === $this) {
                $fkCarnetEntretien->setFkIntervention(null);
            }
        }

        return $this;
    }
}
