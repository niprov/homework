<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FormUpload
 *
 * @ORM\Table(name="form_upload")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FormUploadRepository")
 */
class FormUpload
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
     * @ORM\Column(name="FirstName", type="text")
     *
     * @Assert\NotBlank(message="Please provide your first name")
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="text")
     *
     * @Assert\NotBlank(message="Please provide your surname")
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="text")
     *
     * @Assert\NotBlank(message="Please upload image in jpg, jpeg or png format")
     * @Assert\File(
     *     mimeTypes={"image/jpeg" , "image/jpg" , "image/png"},
     *     mimeTypesMessage = "Only the jpg, jpeg, png filetypes are allowed."
     * )
     */
    private $file;


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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return FormUpload
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return FormUpload
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }


}

