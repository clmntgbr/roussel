<?php

namespace App\Message;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Swift_Mailer;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateContactMessageHandler implements MessageHandlerInterface
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var Swift_Mailer */
    private $mailer;

    public function __construct(EntityManagerInterface $em, Swift_Mailer $mailer)
    {
        $this->em = $em;
        $this->mailer = $mailer;
    }
    public function __invoke(CreateContactMessage $command): void
    {
        assert($command instanceof CreateContactMessage);

        $contact = new Contact(
            $command->getName(),
            $command->getEmail(),
            $command->getPhone(),
            $command->getSubject(),
            $command->getBody()
        );

        $message = (new \Swift_Message($command->getSubject()))
            ->setFrom($command->getEmail())
            ->setTo('clement.goubier@gmail.com') //TODO CHANGE IT
            ->setBody($command->getBody());

        $this->mailer->send($message);

        $this->em->persist($contact);
        $this->em->flush();
    }
}
