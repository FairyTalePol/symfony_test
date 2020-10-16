<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attachment
 *
 * @ORM\Table(name="attachment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AttachmentRepository")
 */
class Attachment
{
  
  
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     */
     
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="advertisement_id", type="integer")
     */
    private $advertisement;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255)
     */
    private $link;


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
     * Set advertisement
     *
     * @param integer $advertisement
     *
     * @return Attachment
     */
    public function setAdvertisement($advertisement)
    {
        $this->advertisement = $advertisement;

        return $this;
    }

    /**
     * Get advertisement
     *
     * @return int
     */
    public function getAdvertisement()
    {
        return $this->advertisement;
    }

    /**
     * Set link
     *
     * @param string $link
     *
     * @return Attachment
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }
}

