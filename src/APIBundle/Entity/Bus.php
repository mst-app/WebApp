<?php

namespace APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bus
 *
 * @ORM\Table(name="bus")
 * @ORM\Entity(repositoryClass="APIBundle\Repository\BusRepository")
 */
class Bus
{
    /**
     * @ORM\ManyToMany(targetEntity="APIBundle\Entity\Location", cascade={"persist"})
     */
     private $stops;
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="line", type="string", length=255)
     */
    private $line;
    
    public function __construct() {
        $this->stops = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set line
     *
     * @param string $line
     *
     * @return Bus
     */
    public function setLine($line)
    {
        $this->line = $line;

        return $this;
    }

    /**
     * Get line
     *
     * @return string
     */
    public function getLine()
    {
        return $this->line;
    }
    
    public function addStop(Location $stop)
    {
        $this->stops[] = $stop;

        return $this;
    }

    public function removeStop(Location $stop)
    {
        $this->stops->removeElement($stop);
    }

    public function getStops()
    {
        return $this->stops;
    }
}

