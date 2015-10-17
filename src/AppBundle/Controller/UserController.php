<?php
namespace AppBundle\Controller;

use AppBundle\Models\User;
use AppBundle\Validation\ValidationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * Class UserController
 *
 * @package AppBundle\Controller
 */
class UserController extends Controller
{
    /**
     * @Route("/users", name="user_get_all")
     * @Method({"GET"})
     *
     * @return JsonResponse
     */
    public function getAllUsersAction()
    {
        $users = $this->get('user_manager')->getAllUsers();

        return new JsonResponse($users);
    }

    /**
     * @Route("/users/{id}", name="user_get_one_by_id")
     * @Method({"GET"})
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function getUserByIdAction($id)
    {
        /** @var User $user */
        $user = null;

        try {
            $user = $this->get('user_manager')->getUser($id);
        } catch (ResourceNotFoundException $e) {
            return new JsonResponse($e->getMessage(), 404);
        }

        return new JsonResponse($user);
    }

    /**
     * @Route("/users", name="user_create")
     * @Method({"POST"})
     * @ParamConverter("user", class="AppBundle:User", converter="user_converter")
     *
     * @param User $user
     *
     * @return User
     */
    public function createUserAction(User $user)
    {
        try {
            $this->get('user_manager')->createUser($user);
        } catch (ValidationException $e) {
            return new JsonResponse($e->getMessage(), 400);
        }

        return new JsonResponse($user);
    }

    /**
     * @Route("/users/{id}", name="user_delete")
     * @Method({"DELETE"})
     * @ParamConverter("user", class="AppBundle:User")
     *
     * @param User $user
     *
     * @return JsonResponse
     */
    public function deleteUserAction(User $user)
    {
        $this->get('user_manager')->deleteUser($user);

        return new JsonResponse($user);
    }
}
