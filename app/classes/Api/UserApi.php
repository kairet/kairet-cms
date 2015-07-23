<?php
namespace KCMS\Api;

use KCMS\Database\DbService;
use KCMS\Models\User;

class UserApi extends AbstractApi
{
    /**
     * @param $args
     * @throws \LogicException
     * @return mixed
     */
    protected function handleRequestInternal($args)
    {
        if (!array_key_exists("type", $args)) {
            throw new \InvalidArgumentException("Type-key was not defined");
        }

        switch ($args["type"]) {
            case "userinfo":
                if (!array_key_exists("id", $args)) {
                    throw new \InvalidArgumentException("ID was not defined");
                }
                $em = DbService::getEntityManager();
                /** @var User $user */
                $user = $em->find('KCMS\Models\User', $args["id"]);
                if ($user == null) {
                    throw new \LogicException("Could not find user with id=" . $args["id"]);
                }

                return $user;
                break;
            default:
                throw new \InvalidArgumentException("Type-key was not found");
        }
    }
}
