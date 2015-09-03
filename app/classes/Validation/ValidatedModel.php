<?php
namespace KCMS\Validation;

use Doctrine\ORM\Mapping as ORM;

/**
 * Base class with default implementation for {@see ValidationInterface} including doctrine lifecycle callbacks
 *
 * @ORM\MappedSuperclass
 * @ORM\HasLifecycleCallbacks
 * @package KCMS\Validation
 */
abstract class ValidatedModel implements ValidationInterface
{
    /**
     * @inheritDoc
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function validate()
    {
        ValidationHelper::validate($this);
    }
}
