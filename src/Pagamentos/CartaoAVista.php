<?php

namespace App\Pagamentos;

class CartaoAVista implements PagamentoInterface
{
    public function calcularTotal(float $valor): float
    {
        // 10% de desconto para pagamento à vista no cartão
        return $valor * 0.9;
    }
}
