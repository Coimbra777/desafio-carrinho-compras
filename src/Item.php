<?php

namespace App;

class Item
{
    public string $nome;
    public float $preco;
    public int $quantidade;

    public function __construct(string $nome, float $preco, int $quantidade)
    {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->quantidade = $quantidade;
    }

    public function subtotal(): float
    {
        return $this->preco * $this->quantidade;
    }
}
