<?php
namespace KCMS\Api;

/**
 * Interface RequestHandlerInterface
 * @package KCMS\Api
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
