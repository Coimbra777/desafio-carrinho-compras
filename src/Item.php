<?php

namespace App;

use InvalidArgumentException;

class Item
{
    public readonly string $nome;
    public readonly float $preco;
    public readonly int $quantidade;

    public function __construct(string $nome, float $preco, int $quantidade)
    {
        $this->validar($nome, $preco, $quantidade);

        $this->nome = trim($nome);
        $this->preco = $preco;
        $this->quantidade = $quantidade;
    }

    private function validar(string $nome, float $preco, int $quantidade): void
    {
        if (trim($nome) === '') {
            throw new InvalidArgumentException("Nome do item não pode ser vazio.");
        }

        if ($preco <= 0) {
            throw new InvalidArgumentException("Preço deve ser maior que zero.");
        }

        if ($quantidade < 1) {
            throw new InvalidArgumentException("Quantidade deve ser no mínimo 1.");
        }
    }

    public function subtotal(): float
    {
        return $this->preco * $this->quantidade;
    }
}
