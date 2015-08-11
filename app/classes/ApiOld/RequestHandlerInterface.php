<?php
namespace KCMS\ApiOld;

/**
 * Interface RequestHandlerInterface
 * @package KCMS\ApiOld
 */
interface RequestHandlerInterface
{
    /**
     * @param string[] $args
     * @throws \LogicException
     */
    public function handleRequest($args);

    /**
     * @return mixed
     */
    public function getResponse();
}
