<?php

namespace ChicoRei\Packages\Correios;

class Account extends CorreiosObject
{
    /**
     * Correios username
     */
    public ?string $username = null;

    /**
     * Correios password
     */
    public ?string $password = null;

    /**
     * Correios contract
     */
    public ?string $contract = null;

    /**
     * Correios Postcard
     */
    public ?string $postcard = null;

    /**
     * Número do Regional/DR/SE do contrato
     */
    public ?int $dr = null;

    /**
     * Correios sandbox
     */
    public bool $sandbox = false;

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): Account
    {
        $this->username = $username;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): Account
    {
        $this->password = $password;
        return $this;
    }

    public function getContract(): ?string
    {
        return $this->contract;
    }

    public function setContract(?string $contract): Account
    {
        $this->contract = $contract;
        return $this;
    }

    public function getPostcard(): ?string
    {
        return $this->postcard;
    }

    public function setPostcard(?string $postcard): Account
    {
        $this->postcard = $postcard;
        return $this;
    }

    public function getDr(): ?int
    {
        return $this->dr;
    }

    public function setDr(?int $dr): Account
    {
        $this->dr = $dr;
        return $this;
    }

    public function isSandbox(): bool
    {
        return $this->sandbox;
    }

    public function setSandbox(bool $sandbox): Account
    {
        $this->sandbox = $sandbox;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
            'contract' => $this->getContract(),
            'postcard' => $this->getPostcard(),
            'dr' => $this->getDr(),
            'sandbox' => $this->isSandbox(),
        ];
    }
}
