<?php

namespace App;

class Carrinho
{
    /** @var Item[] */
    private array $itens;

    public function __construct(array $itens)
    {
        $this->itens = $itens;
    }

    public function total(): float
    {
        $total = 0.0;
        foreach ($this->itens as $item) {
            $total += $item->subtotal();
        }
        return $total;
    }
}
