<?php

namespace App\Controller;

use App\Form\LoginType;
use App\Util\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        $form = $this->createForm(LoginType::class, null, [
            'action' => $this->generateUrl('login_confirmation'),
            'method' => 'POST'
        ]);

        return $this->render('security/login.html.twig', [
            'login' => $form->createView()
        ]);
    }

    /**
     * @Route("/login_confirmation", name="login_confirmation")
     */
    public function loginConfirmationAction(Request $request, Security $security)
    {
        $data = $request->request->get('login');
        if (isset($data['email'], $data['password'], $data['_token'])) {
            if ($security->login($data['email'], $data['password'])) {
                return $this->redirectToRoute('sonata_admin_dashboard');
            }
        }
        return $this->redirectToRoute('login');
    }
}
