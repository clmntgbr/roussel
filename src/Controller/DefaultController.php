<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Contact;
use App\Entity\Transaction;
use App\Entity\User;
use App\Form\ContactType;
use App\Message\CreateContactMessage;
use ReCaptcha\ReCaptcha;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction()
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ContactType::class, new Contact(null, null, null, null, null), [
            'action' => $this->generateUrl('mailer'),
            'method' => 'POST'
        ]);

        return $this->render('default/homepage.html.twig', [
            'articles' => $em->getRepository(Article::class)->findAll(),
            'transactions' => $em->getRepository(Transaction::class)->findAll(),
            'user' => $em->getRepository(User::class)->findOneBy(['email' => 'yroussel62@gmail.com']),
            'contact' => $form->createView()
        ]);
    }

    /**
     * @Route("/mailer", name="mailer")
     */
    public function mailerAction(Request $request, MessageBusInterface $messageBus)
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__.'/../../.env.local');

        $recaptcha = new ReCaptcha($_ENV['GOOGLE_RECAPTCHA_SECRET']);
        $response = $recaptcha->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());

        if (!$response->isSuccess()) {
            $this->addFlash('alert', "Le reCAPTCHA n'a pas été validé correctement. Veuillez ressayer.");
            return $this->redirectToRoute('homepage');
        }

        $data = $request->request->get('contact');
        if (isset($data['name'], $data['email'], $data['phone'], $data['subject'], $data['body'], $data['_token'])) {
            $message = new CreateContactMessage(
                $data['name'],
                $data['email'],
                $data['phone'],
                $data['subject'],
                $data['body']
            );

            $messageBus->dispatch($message);
            $this->addFlash('success', 'Votre message a bien été envoyé.');
            return $this->redirectToRoute('homepage');
        }

        $this->addFlash('alert', 'Un problème est apparu avec votre message.');
        return $this->redirectToRoute('homepage');
    }
}
