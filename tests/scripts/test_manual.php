<?php

require __DIR__ . '/../../vendor/autoload.php';

use App\Item;
use App\Carrinho;
use App\CalculadoraPagamento;
use App\Pagamentos\Pix;
use App\Pagamentos\CartaoAVista;
use App\Pagamentos\CartaoParcelado;

$carrinho = new Carrinho();

// Adiciona itens
$carrinho->adicionarItem(new Item("Camisa", 50, 1));
$carrinho->adicionarItem(new Item("Calça", 100, 1));
$carrinho->adicionarItem(new Item("Sapato", 150, 1));

echo "Total bruto (sem descontos): R$ " . $carrinho->total() . PHP_EOL;

// Pagamento com Pix
$pix = new Pix();
echo "Total com Pix: R$ " . CalculadoraPagamento::calcular($carrinho, $pix) . PHP_EOL;

// Pagamento com Cartão à Vista
/* $avista = new CartaoAVista();
echo "Total com Cartão à Vista: R$ " . CalculadoraPagamento::calcular($carrinho, $avista) . PHP_EOL; */

// Pagamento Parcelado em (n)x
/* $parcelamento = 10;
$parcelado = new CartaoParcelado($parcelamento);
echo "Total parcelado em " . $parcelamento . "x: R$ " . CalculadoraPagamento::calcular($carrinho, $parcelado) . PHP_EOL; */

// Remove item
/* $carrinho->removerItemPorNome("Camisa");
echo "Total após remover 'Camisa': R$ " . $carrinho->total() . PHP_EOL; */

// Exemplo com valores quebrados
/* $carrinho = new Carrinho();
$carrinho->adicionarItem(new Item("Livro", 49.99, 1));
$carrinho->adicionarItem(new Item("Caderno", 15.50, 2));
$carrinho->adicionarItem(new Item("Caneta", 2.75, 3));

echo "Total bruto: R$ " . $carrinho->total() . PHP_EOL;

$pix = new Pix();
echo "Total com Pix: R$ " . CalculadoraPagamento::calcular($carrinho, $pix) . PHP_EOL;

$cartaoParcelado = new CartaoParcelado(2);
echo "Total parcelado em 2x: R$ " . CalculadoraPagamento::calcular($carrinho, $cartaoParcelado) . PHP_EOL; */
