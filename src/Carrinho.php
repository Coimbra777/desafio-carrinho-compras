<?php

namespace App;

class Carrinho
{
    /**
     * @var Item[]
     */
    private array $itens = [];

    public function __construct(array $itens = [])
    {
        foreach ($itens as $item) {
            $this->adicionarItem($item);
        }
    }

    public function adicionarItem(Item $item): void
    {
        $this->itens[] = $item;
    }

    public function removerItemPorNome(string $nome): void
    {
        foreach ($this->itens as $index => $item) {
            if (strtolower($item->nome) === strtolower($nome)) {
                unset($this->itens[$index]);
                $this->itens = array_values($this->itens);
                return;
            }
        }
    }

    public function total(): float
    {
        $soma = 0.0;
        foreach ($this->itens as $item) {
            $soma += $item->subtotal();
        }
        return $soma;
    }

    public function itens(): array
    {
        return $this->itens;
    }
}
