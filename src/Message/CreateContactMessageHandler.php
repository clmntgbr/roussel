<?php

namespace App\Message;

use App\Entity\Contact;
use App\Util\Mailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateContactMessageHandler implements MessageHandlerInterface
{
    /** @var EntityManagerInterface */
    private $em;

    /** @var Mailer */
    private $mailer;

    public function __construct(EntityManagerInterface $em, Mailer $mailer)
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

        $this->mailer->send(
            $command->getEmail(),
            'contact',
            [
                'name' => $command->getName(),
                'email' => $command->getEmail(),
                'phone' => $command->getPhone(),
                'body' => $command->getBody(),
                'subject' => $command->getSubject()
            ]
        );

        $this->em->persist($contact);
        $this->em->flush();
    }
}
