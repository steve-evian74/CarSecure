<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UploadImageRepository")
 */
class UploadImage {

/**
 * @ORM\Id()
 * @ORM\GeneratedValue()
 * @ORM\Column(type="integer")
 */
private $id;

/**
 * @ORM\Column(type="string")
 *
 * @Assert\NotBlank(message="Veuillez d'utiliser le format Jpg ou Jpeg")
 * @Assert\File(mimeTypes={"image/png","image/jpeg" }, maxSize = "6M")
 * 
 */
private $image;

/**
 * @ORM\ManyToOne(targetEntity="App\Entity\Voiture", inversedBy="fkUploadVoitureImage")
 */
private $fkVoitureUpload;


public function getId() {
return $this->id;
}

public function getImage() {
return $this->image;
}

public function setImage($image) {

$this->image = $image;
return $this;
}


public function getFkVoitureUpload(): ?Voiture
{
return $this->fkVoitureUpload;
}

public function setFkVoitureUpload(?Voiture $fkVoitureUpload): self
{
$this->fkVoitureUpload = $fkVoitureUpload;

return $this;
}

}
