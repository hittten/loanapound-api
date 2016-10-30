<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Loan
 *
 * @ORM\Table()
 * @ORM\Entity
 *
 * @Serializer\ExclusionPolicy("all")
 */
class Loan
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Serializer\Type("integer")
     * @Serializer\Expose()
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="The provider should not be blank.")
     * @Assert\Length(
     *      min = 3,
     *      max = 255,
     *      minMessage = "The provider should be at least {{ limit }} characters.",
     *      maxMessage = "The provider can not have more than {{ limit }} characters."
     * )
     *
     * @Serializer\Type("string")
     * @Serializer\Expose()
     */
    protected $provider;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", length=5)
     *
     * @Assert\NotBlank(message="The borrowing rate should not be blank.")
     * @Assert\Range(
     *      min = 1,
     *      max = 10000,
     *      minMessage = "The borrowing rate should be at least {{ limit }}.",
     *      maxMessage = "The borrowing rate can not have more than {{ limit }}."
     * )
     *
     * @Serializer\Type("integer")
     * @Serializer\Expose()
     */
    protected $borrowingRate;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", length=3)
     *
     * @Assert\NotBlank(message="The term rate should not be blank.")
     * @Assert\Range(
     *      min = 1,
     *      max = 100,
     *      minMessage = "The term should be at least {{ limit }} year.",
     *      maxMessage = "The term rate can not have more than {{ limit }} years."
     * )
     *
     * @Serializer\Type("integer")
     * @Serializer\Expose()
     */
    protected $term;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     *
     * @return $this
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * @return int
     */
    public function getBorrowingRate()
    {
        return $this->borrowingRate;
    }

    /**
     * @param int $borrowingRate
     *
     * @return $this
     */
    public function setBorrowingRate($borrowingRate)
    {
        $this->borrowingRate = $borrowingRate;

        return $this;
    }

    /**
     * @return integer
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * @param integer $term
     *
     * @return $this
     */
    public function setTerm($term)
    {
        $this->term = $term;

        return $this;
    }
}
