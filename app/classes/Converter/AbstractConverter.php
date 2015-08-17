<?php
namespace KCMS\Converter;

use Doctrine\ORM\EntityManager;

/**
 * Class AbstractConverter
 * @package KCMS\Converter
 */
abstract class AbstractConverter
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * AbstractConverter constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $id
     * @return object
     */
    abstract public function convertFromId($id);

    /**
     * @param $json
     * @return object
     */
    abstract public function convertFromJson($json);
}
