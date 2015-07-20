<?php
namespace KCMS\Models;

/**
 * Class User
 * @package KCMS\Models
 */
class User
{
    /**
     * @var String
     */
    private $name;

    /**
     * User constructor.
     * @param String $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param String $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
