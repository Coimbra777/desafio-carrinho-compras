<?php

use PHPUnit\Framework\TestCase;
use App\Item;
use App\Carrinho;
use App\CalculadoraPagamento;
use App\Pagamentos\Pix;
use App\Pagamentos\CartaoAVista;
use App\Pagamentos\CartaoParcelado;
use InvalidArgumentException;

class CarrinhoTest extends TestCase
{
    public function testCalculaTotalSemDescontos(): void
    {
        $itens = [
            new Item("Camisa", 50.0, 2),
            new Item("Calça", 100.0, 1)
        ];

        $carrinho = new Carrinho($itens);

        $this->assertEquals(200, $carrinho->total());
    }

    public function testCalculaTotalComPagamentoPix(): void
    {
        $carrinho = new Carrinho([
            new Item("Camisa", 50, 2),
            new Item("Calça", 100, 1)
        ]);

        $pix = new Pix();
        $total = CalculadoraPagamento::calcular($carrinho, $pix);

        $this->assertEquals(180, $total);
    }

    public function testCalculaTotalComCartaoAVista(): void
    {
        $carrinho = new Carrinho([
            new Item("Camisa", 50, 2),
            new Item("Calça", 100, 1)
        ]);

        $cartao = new CartaoAVista();
        $total = CalculadoraPagamento::calcular($carrinho, $cartao);

        $this->assertEquals(180, $total);
    }

    public function testCalculaTotalComCartaoParceladoEm3x(): void
    {
        $carrinho = new Carrinho([
            new Item("Camisa", 50, 2),
            new Item("Calça", 100, 1)
        ]);

        $cartaoParcelado = new CartaoParcelado(3);
        $esperado = round(200 * pow(1.01, 3), 2);
        $total = CalculadoraPagamento::calcular($carrinho, $cartaoParcelado);

        $this->assertEquals($esperado, $total);
    }

    public function testCartaoParceladoComParcelasInvalidasLancaExcecao(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new CartaoParcelado(13);
    }

    public function testAdicionaECalculaItemNoCarrinho(): void
    {
        $carrinho = new Carrinho();
        $carrinho->adicionarItem(new Item("Boné", 30, 3));

        $this->assertSame(90.0, $carrinho->total());
    }

    public function testRemoveItemDoCarrinho(): void
    {
        $carrinho = new Carrinho([
            new Item("Boné", 30, 3),
            new Item("Meia", 10, 2)
        ]);

        $carrinho->removerItemPorNome("Boné");

        $this->assertEquals(20, $carrinho->total());
    }

    public function testCalculaComValoresDecimais(): void
    {
        $carrinho = new Carrinho([
            new Item("Livro", 49.99, 1),
            new Item("Caderno", 15.50, 2),
            new Item("Caneta", 2.75, 3),
        ]);

        $totalBruto = $carrinho->total();
        $this->assertEqualsWithDelta(89.24, $totalBruto, 0.01);

        $pix = new Pix();
        $totalPix = CalculadoraPagamento::calcular($carrinho, $pix);
        $this->assertEqualsWithDelta(89.24 * 0.9, $totalPix, 0.01);

        $cartao = new CartaoParcelado(2);
        $totalComJuros = CalculadoraPagamento::calcular($carrinho, $cartao);
        $esperado = round(89.24 * pow(1.01, 2), 2);
        $this->assertEqualsWithDelta($esperado, $totalComJuros, 0.01);
    }
}
