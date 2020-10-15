<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Advertisement
 *
 * @ORM\Table(name="advertisement")
 * @ORM\Entity
 */
class Advertisement
{
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="text", nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="links", type="text", nullable=true)
     */
    private $links;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="advertisement_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;




    /**
     * Get the value of description
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param  string  $description
     *
     * @return  self
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of price
     *
     * @return  string
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param  string  $price
     *
     * @return  self
     */ 
    public function setPrice(string $price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of links
     *
     * @return  string
     */ 
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Set the value of links
     *
     * @param  string  $links
     *
     * @return  self
     */ 
    public function setLinks(string $links)
    {
        $this->links = $links;

        return $this;
    }

    /**
     * Get the value of id
     *
     * @return  integer
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  integer  $id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function toJson()
    {
        $obj =  (object)[];
        $obj->id = $this->getId();
        $obj->links = $this->getLinks();
        $obj->description = $this->getDescription();
        $obj->price = $this->getPrice();

        return json_encode($obj);
    }
}

