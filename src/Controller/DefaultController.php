<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Transaction;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        return $this->render('default/index.html.twig', [
            'articles' => $em->getRepository(Article::class)->findAll(),
            'transactions' => $em->getRepository(Transaction::class)->findAll(),
            'user' => $em->getRepository(User::class)->findOneBy(['email' => 'yroussel62@gmail.com'])
        ]);
    }
}
