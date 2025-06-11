<?php

namespace App;

use App\Pagamentos\PagamentoInterface;

class CalculadoraPagamento
{
    public static function calcular(Carrinho $carrinho, PagamentoInterface $pagamento): float
    {
        $total = $carrinho->total();
        return $pagamento->calcularTotal($total);
    }
}
