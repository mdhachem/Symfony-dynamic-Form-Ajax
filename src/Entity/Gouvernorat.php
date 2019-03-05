<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GouvernoratRepository")
 */
class Gouvernorat
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\City", mappedBy="gouvernorat")
     */
    private $cities;

    public function __construct()
    {
        $this->cities = new ArrayCollection();
    }

    public function getId() : ? int
    {
        return $this->id;
    }

    public function getName() : ? string
    {
        return $this->name;
    }

    public function setName(string $name) : self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|City[]
     */
    public function getCities() : Collection
    {
        return $this->cities;
    }

    public function addCity(City $city) : self
    {
        if (!$this->cities->contains($city)) {
            $this->cities[] = $city;
            $city->setGouvernorat($this);
        }

        return $this;
    }

    public function removeCity(City $city) : self
    {
        if ($this->cities->contains($city)) {
            $this->cities->removeElement($city);
            // set the owning side to null (unless already changed)
            if ($city->getGouvernorat() === $this) {
                $city->setGouvernorat(null);
            }
        }

        return $this;
    }



    public function __toString()
    {
        return $this->name;
    }
}
