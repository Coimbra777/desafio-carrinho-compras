<?php

namespace App\Pagamentos;

use InvalidArgumentException;

class CartaoParcelado implements PagamentoInterface
{
    private int $parcelas;

    public function __construct(int $parcelas)
    {
        if ($parcelas < 1 || $parcelas > 12) {
            throw new InvalidArgumentException("Parcelas inválidas");
        }
        $this->parcelas = $parcelas;
    }

    public function calcularTotal(float $valor): float
    {
        // Juros compostos de 1% ao mês
        return round($valor * pow(1.01, $this->parcelas), 2);
    }
}
