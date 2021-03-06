<?php

declare(strict_types=1);

namespace App\Controller;

use App\HttpFoundation\ApiResponse;
use App\Security\AuthenticationProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class SecurityController extends BaseController
{
    /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function login(Request $request, AuthenticationProvider $authProvider): ApiResponse
    {
        $data = json_decode($request->getContent(), true);

        try {
            $token = $authProvider->authenticateAndCreateJWT($data);
            $response = [
                'token' => $token->__toString(),
                'username' => $token->getClaim('username'),
                'email' => $token->getClaim('email'),
            ];

            return new ApiResponse($response);
        } catch (BadCredentialsException $e) {
            throw new UnauthorizedHttpException('None', 'login.bad_credentials', $e);
        } catch (\Exception $e) {
            throw new UnauthorizedHttpException('None', 'login.bad_credentials', $e);
        }
    }
}
