<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieInterventionRepository")
 */
class CategorieIntervention
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CategorieIntervention", mappedBy="FkIntervention")
     */
    private $fkCategorieIntervention;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Intervention", mappedBy="FkCategorieIntervention")
     */
    private $fkIntervention;

    public function __construct()
    {
        $this->fkCategorieIntervention = new ArrayCollection();
        $this->fkIntervention = new ArrayCollection();
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

    /**
     * @return Collection|CategorieIntervention[]
     */
    public function getFkCategorieIntervention(): Collection
    {
        return $this->fkCategorieIntervention;
    }

    public function addFkCategorieIntervention(CategorieIntervention $fkCategorieIntervention): self
    {
        if (!$this->fkCategorieIntervention->contains($fkCategorieIntervention)) {
            $this->fkCategorieIntervention[] = $fkCategorieIntervention;
            $fkCategorieIntervention->setFkIntervention($this);
        }

        return $this;
    }

    public function removeFkCategorieIntervention(CategorieIntervention $fkCategorieIntervention): self
    {
        if ($this->fkCategorieIntervention->contains($fkCategorieIntervention)) {
            $this->fkCategorieIntervention->removeElement($fkCategorieIntervention);
            // set the owning side to null (unless already changed)
            if ($fkCategorieIntervention->getFkIntervention() === $this) {
                $fkCategorieIntervention->setFkIntervention(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Intervention[]
     */
    public function getFkIntervention(): Collection
    {
        return $this->fkIntervention;
    }

    public function addFkIntervention(Intervention $fkIntervention): self
    {
        if (!$this->fkIntervention->contains($fkIntervention)) {
            $this->fkIntervention[] = $fkIntervention;
            $fkIntervention->setFkCategorieIntervention($this);
        }

        return $this;
    }

    public function removeFkIntervention(Intervention $fkIntervention): self
    {
        if ($this->fkIntervention->contains($fkIntervention)) {
            $this->fkIntervention->removeElement($fkIntervention);
            // set the owning side to null (unless already changed)
            if ($fkIntervention->getFkCategorieIntervention() === $this) {
                $fkIntervention->setFkCategorieIntervention(null);
            }
        }

        return $this;
    }
}
