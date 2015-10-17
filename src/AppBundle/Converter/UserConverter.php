<?php
namespace AppBundle\Converter;

use AppBundle\Models\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UserConverter
 *
 * @package AppBundle\Converter
 */
class UserConverter implements ParamConverterInterface
{
    public function apply(Request $request, ParamConverter $configuration)
    {
        $decoded = json_decode($request->getContent(), true);

        $user = User::createUser(
            $decoded['username'] ?: null,
            $decoded['firstName'] ?: null,
            $decoded['lastName'] ?: null,
            $decoded['email'] ?: null,
            $decoded['password'] ?: null
        );



        if ($user === null) {
            throw new \InvalidArgumentException('User could not be created, invalid arguments.', 400);
        } else {
            $request->attributes->set($configuration->getName(), $user);
        }
    }

    public function supports(ParamConverter $configuration)
    {
        //return $configuration->getClass() === 'AppBundle\Models\User';
        return true;
    }
}
