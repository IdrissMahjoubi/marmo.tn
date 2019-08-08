<?php

namespace FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Realisation
 *
 * @ORM\Table(name="realisation")
 * @ORM\Entity(repositoryClass="FrontBundle\Repository\RealisationRepository")
 */
class Realisation
{
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @return string
     */
    public function getDescription2()
    {
        return $this->description2;
    }

    /**
     * @param string $description2
     */
    public function setDescription2($description2)
    {
        $this->description2 = $description2;
    }
    /**
     * @var string
     *
     * @ORM\Column(name="name2", type="string", length=255)
     */
    private $name2;

    /**
     * @return string
     */
    public function getName2()
    {
        return $this->name2;
    }

    /**
     * @param string $name2
     */
    public function setName2($name2)
    {
        $this->name2 = $name2;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="description2", type="text",nullable=true)
     */
    private $description2;

    /**
     * @ORM\OneToOne(targetEntity="FrontBundle\Entity\Image", inversedBy="gallery", cascade={"persist"})
     */
    private $image;


    /**
     * @ORM\OneToMany(targetEntity="FrontBundle\Entity\Gallery",mappedBy="realisation")
     */
    private $Gallery;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Set image
     *
     * @param Image $image
     *
     * @return Realisation
     */
    public function setImage(Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return Image
     */
    public function getImage()
    {
        return $this->image;
    }




    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Gallery = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add product
     *
     * @param \FrontBundle\Entity\Gallery $Gallery
     *
     * @return Realisation
     */
    public function addGallery(\FrontBundle\Entity\Gallery $Gallery)
    {
        $this->Gallery[] = $Gallery;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \FrontBundle\Entity\Gallery $Gallery
     */
    public function removeGallery(\FrontBundle\Entity\Gallery $Gallery)
    {
        $this->$Gallery->removeElement($Gallery);
    }

    /**
     * Get product
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGallery()
    {
        return $this->Gallery;
    }


}
