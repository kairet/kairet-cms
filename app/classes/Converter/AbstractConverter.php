<?php
namespace KCMS\Converter;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

/**
 * Abstract base for converter-classes to be used especially for route-parameter conversion.
 *
 * Implementations agree to convert entity-ids to model-instances and may use Doctrine for receiving these entities from
 * the database. The {@see EntityManager} is made available using dependency injection on initialization of the
 * converter. Also JSON-objects must be converted to new model-instances that may be created/saved on the database at
 * a later point.
 *
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
     *
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Receive a model-instance using its primary identifier
     *
     * @param mixed $id Id of the requested entity
     *
     * @return object
     */
    abstract public function convertFromId($id);

    /**
     * Create a new model-instance from a json-object that is contained in a {@see Request}-body
     *
     * @param null    $null
     * @param Request $request
     *
     * @return object
     */
    abstract public function convertFromRequestBody($null, Request $request);
}
