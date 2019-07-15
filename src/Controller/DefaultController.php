<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Contact;
use App\Entity\Transaction;
use App\Entity\User;
use App\Form\ContactType;
use App\Message\CreateContactMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
            $this->addFlash('success', 'Your message have been sended.');
            return $this->redirectToRoute('homepage');
        }

        $this->addFlash('error', 'A problem have been encountered with your message.');
        return $this->redirectToRoute('homepage');
    }
}
