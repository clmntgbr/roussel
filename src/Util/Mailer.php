<?php

namespace App\Util;

use Swift_Mailer;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Templating\EngineInterface;

class Mailer
{
    /** @var EngineInterface */
    private $templating;

    /** @var Swift_Mailer */
    private $swiftMailer;

    public function __construct(EngineInterface $templating, Swift_Mailer $swiftMailer)
    {
        $this->templating = $templating;
        $this->swiftMailer = $swiftMailer;
    }

    public function send(string $forwarder, string $template, array $options)
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__.'/../../.env.local');



        $message = (new \Swift_Message())
            ->setFrom($forwarder)
            ->setTo($_ENV['EMAIL_TO_SEND'])
            ->setSubject('You receive an email from RCapital.fr')
            ->setBody(
                $this->templating->render(
                    sprintf('emails/%s.html.twig', $template),
                    $options
                ), 'text/html'
            );

        $this->swiftMailer->send($message);
    }
}
