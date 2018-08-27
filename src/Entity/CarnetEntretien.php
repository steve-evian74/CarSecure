<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarnetEntretienRepository")
 */
class CarnetEntretien
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateIntervention;

    /**
     * @ORM\Column(type="integer")
     */
    private $kilometre;

    /**
     * @ORM\Column(type="text")
     */
    private $commentaireIntervention;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Voiture", inversedBy="fkCarnetEntretien")
     */
    private $fkVoiture;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $fkUserGarage;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Intervention", inversedBy="fkCarnetEntretien")
     */
    private $fkIntervention;





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateIntervention(): ?\DateTimeInterface
    {
        return $this->dateIntervention;
    }

    public function setDateIntervention(\DateTimeInterface $dateIntervention): self
    {
        $this->dateIntervention = $dateIntervention;

        return $this;
    }

    public function getKilometre(): ?int
    {
        return $this->kilometre;
    }

    public function setKilometre(int $kilometre): self
    {
        $this->kilometre = $kilometre;

        return $this;
    }

    public function getCommentaireIntervention(): ?string
    {
        return $this->commentaireIntervention;
    }

    public function setCommentaireIntervention(string $commentaireIntervention): self
    {
        $this->commentaireIntervention = $commentaireIntervention;

        return $this;
    }

    public function getFkVoiture(): ?Voiture
    {
        return $this->fkVoiture;
    }

    public function setFkVoiture(?Voiture $fkVoiture): self
    {
        $this->fkVoiture = $fkVoiture;

        return $this;
    }

    public function getFkUserGarage(): ?User
    {
        return $this->fkUserGarage;
    }

    public function setFkUserGarage(?User $fkUserGarage): self
    {
        $this->fkUserGarage = $fkUserGarage;

        return $this;
    }

    public function getFkIntervention(): ?Intervention
    {
        return $this->fkIntervention;
    }

    public function setFkIntervention(?Intervention $fkIntervention): self
    {
        $this->fkIntervention = $fkIntervention;

        return $this;
    }


}
