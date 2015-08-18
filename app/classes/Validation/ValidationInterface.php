<?php
namespace KCMS\Validation;

use Doctrine\ORM\Mapping as ORM;

/**
 * Indicates an object implements validation logic
 * @package KCMS\Validation
 */
interface ValidationInterface
{
    /**
     * Validate an object, throw {@see ValidationException} if invalid
     * @ORM\PrePersist @ORM\PreUpdate
     * @throws ValidationException
     */
    public function validate();
}
