<?php
namespace KCMS\Converter;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

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
     * @param         $null
     * @param Request $request
     * @return object
     */
    abstract public function convertFromRequestBody($null, Request $request);
}
