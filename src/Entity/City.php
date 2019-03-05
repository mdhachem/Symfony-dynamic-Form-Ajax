<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 */
class City
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Gouvernorat", inversedBy="cities")
     */
    private $gouvernorat;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Plan", mappedBy="city")
     */
    private $plans;

    public function __construct()
    {
        $this->plans = new ArrayCollection();
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

    public function getGouvernorat() : ? Gouvernorat
    {
        return $this->gouvernorat;
    }

    public function setGouvernorat(? Gouvernorat $gouvernorat) : self
    {
        $this->gouvernorat = $gouvernorat;

        return $this;
    }

    /**
     * @return Collection|Plan[]
     */
    public function getPlans() : Collection
    {
        return $this->plans;
    }

    public function addPlan(Plan $plan) : self
    {
        if (!$this->plans->contains($plan)) {
            $this->plans[] = $plan;
            $plan->setCity($this);
        }

        return $this;
    }

    public function removePlan(Plan $plan) : self
    {
        if ($this->plans->contains($plan)) {
            $this->plans->removeElement($plan);
            // set the owning side to null (unless already changed)
            if ($plan->getCity() === $this) {
                $plan->setCity(null);
            }
        }

        return $this;
    }


    public function __toString()
    {
        return $this->name;
    }
}
