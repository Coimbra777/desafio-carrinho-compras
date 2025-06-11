<?php

namespace App\Pagamentos;

class Pix implements PagamentoInterface
{
    public function calcularTotal(float $valor): float
    {
        // 10% de desconto para pagamento via Pix
        return $valor * 0.9;
    }
}
