<?php
namespace AppBundle\Models;

use AppBundle\Validation\ValidationInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Base class with default implementation for {@see ValidationInterface} including doctrine lifecycle callbacks
 *
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 * @package AppBundle\Models
 */
abstract class ValidatedModel implements ValidationInterface
{
    /**|
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * ValidatedModel constructor.
     *
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @inheritDoc
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function validate()
    {
        $this->validator->validate($this);
    }
}
