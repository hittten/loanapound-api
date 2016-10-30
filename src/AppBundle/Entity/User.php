<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * User
 *
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 *
 * @Serializer\ExclusionPolicy("all")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     *
     * @Assert\NotBlank(message="The name should not be blank.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "The name should be at least {{ limit }} characters.",
     *      maxMessage = "The name can not have more than {{ limit }} characters.",
     *      groups={"Registration", "Profile"}
     * )
     * @Serializer\Type("string")
     * @Serializer\Expose()
     */
    protected $firstName;

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }
}
