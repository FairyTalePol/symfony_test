<?php

namespace AppBundle\Entity;
use AppBundle\Entity\Advertisement;
use AppBundle\Entity\Attachment;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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

    private $attachments;


    public function __construct()
    {
        $this->attachments = new ArrayCollection();
    }

    public function getAttachments()
    {
        $res = [];
        foreach($this->attachments as $at)
        {
            $res[] = $at->getLink();
        }
        return $res;
    }

    public function setAttachments(?Attachment $attachment): self
    {
        $this->attachments = $attachment;

        return $this;
    }

    public function toJson()
    {
        $obj =  (object)[];
        $obj->id = $this->getId();
        $obj->description = $this->getDescription();
        $obj->price = $this->getPrice();
        $obj->links = $this->getAttachments();

        return json_encode($obj);
    }
}

