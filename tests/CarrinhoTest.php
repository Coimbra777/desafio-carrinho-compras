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
    private Carrinho $carrinho;

    protected function setUp(): void
    {
        $itens = [
            new Item("Camisa", 50.0, 2),
            new Item("Calça", 100.0, 1)
        ];
        $this->carrinho = new Carrinho($itens);
    }

    public function testTotalSemDesconto(): void
    {
        $this->assertEquals(200.0, $this->carrinho->total());
    }

    public function testPagamentoPix(): void
    {
        $pagamento = new Pix();
        $total = CalculadoraPagamento::calcular($this->carrinho, $pagamento);
        $this->assertEquals(180.0, $total);
    }

    public function testPagamentoCartaoAVista(): void
    {
        $pagamento = new CartaoAVista();
        $total = CalculadoraPagamento::calcular($this->carrinho, $pagamento);
        $this->assertEquals(180.0, $total);
    }

    public function testPagamentoCartaoParcelado3x(): void
    {
        $pagamento = new CartaoParcelado(3);
        $total = CalculadoraPagamento::calcular($this->carrinho, $pagamento);
        $esperado = round(200.0 * pow(1.01, 3), 2);
        $this->assertEquals($esperado, $total);
    }

    public function testParcelasInvalidas(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new CartaoParcelado(13);
    }
}
