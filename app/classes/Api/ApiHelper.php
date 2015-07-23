<?php
namespace KCMS\Api;

class ApiHelper implements RequestHandlerInterface
{
    /**
     * @var bool
     */
    private $requestHandled = false;

    /**
     * @var string
     */
    private $lastResponse;

    /**
     * @var bool
     */
    private $lastRequestSuccess = false;

    /**
     * @param string[] $args
     * @throws \InvalidArgumentException
     */
    public function handleRequest($args)
    {
        try {
            if (!array_key_exists("api", $args)) {
                throw new \InvalidArgumentException("Need to define key 'api'");
            }

            /** @var AbstractApi $foundApi */
            $foundApi = null;
            switch ($args["api"]) {
                case "user":
                case "users":
                    $foundApi = new UserApi();
                    break;
                default:
                    throw new \InvalidArgumentException("API with key" . $args["api"] . " not found");
            }

            $foundApi->handleRequest($args);
            $this->lastResponse = $foundApi->getResponse();
            $this->lastRequestSuccess = true;
        } catch (\Exception $e) {
            $this->lastResponse = $e->getMessage();
            $this->lastRequestSuccess = false;
        }

        $this->requestHandled = true;
    }

    /**
     * @throws \LogicException
     * @return mixed
     */
    public function getResponse()
    {
        if ($this->requestHandled) {
            return $this->lastResponse;
        } else {
            throw new \LogicException("No request has been handled yet");
        }
    }

    /**
     * @return string
     */
    public function getJsonReponse()
    {
        return json_encode(
            [
                "success"  => $this->lastRequestSuccess,
                "response" => json_encode($this->lastResponse, JSON_UNESCAPED_SLASHES)
            ],
            JSON_UNESCAPED_SLASHES
        );
    }
}
