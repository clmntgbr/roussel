<?php

namespace App\Util;

use Swift_Mailer;
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

    public function send(string $forwarder, string $subject, string $template, array $options)
    {
        $message = (new \Swift_Message($subject))
            ->setFrom($forwarder)
            ->setTo('clement.goubier@gmail.com')
            ->setBody(
                $this->templating->render(
                    sprintf('emails/%s.html.twig', $template),
                    $options
                ), 'text/html'
            );

        $this->swiftMailer->send($message);
    }
}
