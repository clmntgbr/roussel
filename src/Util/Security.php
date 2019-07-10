<?php

namespace App\Util;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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

    /* @var ValidatorInterface */
    private $validator;

    public function __construct(EncoderFactoryInterface $encoder, UserPasswordEncoderInterface $passwordEncoder, TokenStorageInterface $tokenStorage, SessionInterface $session, EntityManagerInterface $em, ValidatorInterface $validator)
    {
        $this->encoder = $encoder;
        $this->passwordEncoder = $passwordEncoder;
        $this->tokenStorage = $tokenStorage;
        $this->session = $session;
        $this->em = $em;
        $this->validator = $validator;
    }

    public function login($email, $password)
    {
        $constraints = [
            new Email(),
            new NotBlank()
        ];

        /* @var User */
        $user = new User();

        $result = false;

        if ($email !== null && $password !== null) {
            $errors = $this->validator->validate($email, $constraints);
            if (count($errors) > 0) {
                return ["status" => false, "message" => "$email is not a valid email address."];
            } else {
                $user = $this->em->getRepository(User::class)->findOneBy(["email" => $email]);
                if ($user instanceof User) {
                    $encoder = $this->encoder->getEncoder($user);
                    $result = $encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt());
                }
            }
        }

        if ($result) {
            $this->setToken($user);
            $user->setLastLogin(new \DateTime());
            $this->em->persist($user);
            $this->em->flush();
            return ["status" => true];
        }

        return ["status" => false, "message" => "Email or/and password invalid."];
    }

    public function register($email, $password, $passwordConfirmation, $role = 'ROLE_USER', $tokenIt = true)
    {
        $errors = $this->validator->validate($email, [new Email(), new NotBlank()]);
        if (count($errors) > 0) {
            return ["status" => false, "message" => "$email is not a valid email address."];
        }

        $result = $this->em->getRepository(User::class)->findOneBy(['email' => $email]);
        if ($result) {
            return ["status" => false, "message" => "This $email address already exist."];
        }

        $errors = $this->validator->validate($password, [new NotBlank()]);
        if (count($errors) > 0) {
            return ["status" => false, "message" => "Your password is empty."];
        }
        if ($password == $passwordConfirmation) {
            $user = $this->createNewUser($email, $password, $role);
            if ($tokenIt) {
                $this->setToken($user);
            }
            $this->em->persist($user);
            $this->em->flush();
            return ["status" => true, "message" => "User '$email' have been created."];
        }
        return ["status" => false, "message" => "Your passwords must correspond."];
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
