<?php
namespace KCMS\Api;

abstract class AbstractApi implements RequestHandlerInterface
{
    private $lastResponse = null;

    /**
     * @param string[] $args
     * @throws \LogicException
     */
    public function handleRequest($args)
    {
        $this->lastResponse = $this->handleRequestInternal($args);
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->lastResponse;
    }

    /**
     * @param $args
     * @throws \LogicException
     * @return mixed
     */
    abstract protected function handleRequestInternal($args);
}
