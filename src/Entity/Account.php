<?php

namespace App\Entity;

use App\Repository\AccountRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $codigo = null;

    #[ORM\Column]
    private ?int $saldo = null;

    #[ORM\ManyToOne(inversedBy: 'accounts')]
    private ?Client $cliente = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo): static
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getSaldo(): ?int
    {
        return $this->saldo;
    }

    public function setSaldo(int $saldo): static
    {
        $this->saldo = $saldo;

        return $this;
    }

    public function getCliente(): ?Client
    {
        return $this->cliente;
    }

    public function setCliente(?Client $cliente): static
    {
        $this->cliente = $cliente;

        return $this;
    }
}
