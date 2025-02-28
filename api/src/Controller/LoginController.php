<?php

namespace App\Controller;

use ApiPlatform\Metadata\IriConverterInterface;
use ApiPlatform\Metadata\UrlGeneratorInterface;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function userLogin(): Response
    {
        return $this->render('user/login.html.twig');
    }

    #[Route('/login-request', name: 'app_login_request', methods: ['POST'])]
    public function userLoginRequest(IriConverterInterface $iriConverter, #[CurrentUser] ?User $user): Response
    {
        if (!$user) {
            return $this->json([
                'error' => 'check content type'
            ], 401);
        }

        return new Response(null, 204, [
            'Location' => $iriConverter->getIriFromResource($user)
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \Exception('this should not be reached anymore');
    }
}
