<?php

namespace App\Entity;

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
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modele;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero_de_serie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couleur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $plaque_immatriculation;

    /**
     * @ORM\Column(type="integer")
     */
    private $kilometre;

    /**
     * @ORM\Column(type="boolean")
     */
    private $disponible;



    public function getId()
    {
        return $this->id;
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

    /**
     * @return mixed
     */
    public function getNumeroDeSerie()
    {
        return $this->numero_de_serie;
    }

    /**
     * @param mixed $numero_de_serie
     */
    public function setNumeroDeSerie($numero_de_serie): void
    {
        $this->numero_de_serie = $numero_de_serie;
    }

    /**
     * @return mixed
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * @param mixed $couleur
     */
    public function setCouleur($couleur): void
    {
        $this->couleur = $couleur;
    }

    /**
     * @return mixed
     */
    public function getPlaqueImmatriculation()
    {
        return $this->plaque_immatriculation;
    }

    /**
     * @param mixed $plaque_immatriculation
     */
    public function setPlaqueImmatriculation($plaque_immatriculation): void
    {
        $this->plaque_immatriculation = $plaque_immatriculation;
    }

    /**
     * @return mixed
     */
    public function getKilometre()
    {
        return $this->kilometre;
    }

    /**
     * @param mixed $kilometre
     * @return int
     */
    public function setKilometre($kilometre): int
    {
        $this->kilometre = $kilometre;
    }

    /**
     * @return mixed
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * @param mixed $disponible
     * @return bool
     */
    public function setDisponible($disponible): bool
    {
        $this->disponible = $disponible;
    }
}
