<?php

namespace App\Util;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class Security
{
    /** @var EncoderFactoryInterface */
    private $encoder;

    /* @var UserPasswordEncoderInterface */
    private $passwordEncoder;

    /* @var TokenStorageInterface */
    private $tokenStorage;

    /* @var SessionInterface */
    private $session;

    /* @var EntityManagerInterface */
    private $em;

    public function __construct(EncoderFactoryInterface $encoder, UserPasswordEncoderInterface $passwordEncoder, TokenStorageInterface $tokenStorage, SessionInterface $session, EntityManagerInterface $em)
    {
        $this->encoder = $encoder;
        $this->passwordEncoder = $passwordEncoder;
        $this->tokenStorage = $tokenStorage;
        $this->session = $session;
        $this->em = $em;
    }

    public function changePassword(User $entity, string $oldPassword, string $newPassword)
    {
        if ($oldPassword === null || $newPassword === null) {
            return false;
        }

        if (!($this->passwordIsCurrent($entity, $oldPassword))) {
            return false;
        }

        $this->encodePassword($entity, $newPassword);
        $this->setToken($entity);

        $this->em->persist($entity);
        $this->em->flush();
        return true;
    }

    public function passwordIsCurrent(User $user, string $password)
    {
        $encoder = $this->encoder->getEncoder($user);
        return $encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt());
    }

    private function encodePassword(User $user, $password)
    {
        $encodedPassword = $this->passwordEncoder->encodePassword($user, $password);
        $user->setPassword($encodedPassword);
    }

    private function setToken(User $user)
    {
        $token = new UsernamePasswordToken($user, null, "secured_area", $user->getRoles());
        $this->tokenStorage->setToken($token);
        $this->session->set("_security_secured_area", serialize($token));
    }
}
