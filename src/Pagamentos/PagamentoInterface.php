<?php

namespace App\Pagamentos;

interface PagamentoInterface
{
    public function calcularTotal(float $valor): float;
}
