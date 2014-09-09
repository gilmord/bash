<?php

namespace Bash\TestBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Entity(repositoryClass="Kwpro\VguildBundle\Entity\RaceRepository")
 * @ORM\Table(name="races")
 */
class Race
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = "2",
     *  max = "150"
     * )
     * @ORM\Column(type="string", length=150)
     *
     */
    protected $name;

    /**
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = "1",
     *  max = "1"
     * )
     * @Assert\Choice(choices = {"a", "h"}, message = "Choose a valid faction." )
     * @ORM\Column(type="string", length=1)
     */
    protected $faction;

    /**
     * @ORM\ManyToMany(targetEntity="Wclass", mappedBy="races")
     */
    protected $wclasses;

    public function __construct()
    {
        $this->wclasses = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Race
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set faction
     *
     * @param string $faction
     * @return Race
     */
    public function setFaction($faction)
    {
        $this->faction = $faction;

        return $this;
    }

    /**
     * Get faction
     *
     * @return string 
     */
    public function getFaction()
    {
        return $this->faction;
    }

    /**
     * Add wclasses
     *
     * @param \Bash\TestBundle\Entity\Wclass $wclasses
     * @return Race
     */
    public function addWclass(\Bash\TestBundle\Entity\Wclass $wclasses)
    {
        $this->wclasses[] = $wclasses;

        return $this;
    }

    /**
     * Remove wclasses
     *
     * @param \Bash\TestBundle\Entity\Wclass $wclasses
     */
    public function removeWclass(\Bash\TestBundle\Entity\Wclass $wclasses)
    {
        $this->wclasses->removeElement($wclasses);
    }

    /**
     * Get wclasses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWclasses()
    {
        return $this->wclasses;
    }
}
