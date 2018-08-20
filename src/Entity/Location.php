<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationRepository")
 */
class Location
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_achat;

    /**
     * @ORM\Column(type="datetime")
     */
    private $debut_location;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fin_location;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Voiture", mappedBy="Voiture")
     */
    private $Voiture;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Client", mappedBy="Client")
     */
    private $Client;

    public function getId()
    {
        return $this->id;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDateAchat(): ?\DateTimeInterface
    {
        return $this->date_achat;
    }

    public function setDateAchat(\DateTimeInterface $date_achat): self
    {
        $this->date_achat = $date_achat;

        return $this;
    }

    public function getDebutLocation(): ?\DateTimeInterface
    {
        return $this->debut_location;
    }

    public function setDebutLocation(\DateTimeInterface $debut_location): self
    {
        $this->debut_location = $debut_location;

        return $this;
    }

    public function getFinLocation(): ?\DateTimeInterface
    {
        return $this->fin_location;
    }

    public function setFinLocation(\DateTimeInterface $fin_location): self
    {
        $this->fin_location = $fin_location;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getVoiture(): ?Voiture
    {
        return $this->Voiture;
    }

    public function setVoiture(?Voiture $Voiture): self
    {
        $this->Voiture = $Voiture;

        // set (or unset) the owning side of the relation if necessary
        $newVoiture = $Voiture === null ? null : $this;
        if ($newVoiture !== $Voiture->getVoiture()) {
            $Voiture->setVoiture($newVoiture);
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->Client;
    }

    public function setClient(?Client $Client): self
    {
        $this->Client = $Client;

        // set (or unset) the owning side of the relation if necessary
        $newClient = $Client === null ? null : $this;
        if ($newClient !== $Client->getClient()) {
            $Client->setClient($newClient);
        }

        return $this;
    }
}
