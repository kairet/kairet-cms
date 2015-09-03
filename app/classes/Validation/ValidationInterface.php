<?php
namespace KCMS\Validation;

use Doctrine\ORM\Mapping as ORM;

/**
 * Indicates an object implements validation logic, also sets doctrine lifecycle-annotations (logic must be checked
 * against on database insert or update)
 *
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 * @package KCMS\Validation
 */
interface ValidationInterface
{
    /**
     * Validate an object, throw {@see ValidationException} if invalid
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @throws ValidationException
     */
    public function validate();
}
