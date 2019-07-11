<?php

namespace App\Message;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class CreateContactMessage
{
    /**
     * @var string
     *
     * @NotBlank
     * @Type(type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @NotBlank
     * @Type(type="string")
     */
    private $email;

    /**
     * @var string
     *
     * @NotBlank
     * @Type(type="string")
     */
    private $phone;

    /**
     * @var string
     *
     * @NotBlank
     * @Type(type="string")
     */
    private $subject;

    /**
     * @var string
     *
     * @NotBlank
     * @Type(type="string")
     */
    private $body;

    public function __construct(string $name, string $email, string $phone, string $subject, string $body)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }
}
