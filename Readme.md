# Desafio: Carrinho de Compras com Regras de Pagamento

Este projeto é uma simulação de carrinho de compras simples em PHP, com regras específicas de cálculo para diferentes formas de pagamento: Pix, Cartão à Vista e Cartão Parcelado.

---

```bash
🗂 Estrutura

desafio-carrinho-compras/
├── docker/
│ └── Dockerfile
├── src/
│ ├── Item.php
│ ├── Carrinho.php
│ ├── CalculadoraPagamento.php
│ └── Pagamentos/
│ ├── PagamentoInterface.php
│ ├── Pix.php
│ ├── CartaoAVista.php
│ └── CartaoParcelado.php
├── tests/
│ └── CarrinhoTest.php
├── docker-compose.yml
├── composer.json
├── Makefile (opcional)
└── README.md
```

---

## Tecnologias

- PHP 8.2
- PHPUnit 11
- Docker / Docker Compose
- Composer

## Funcionalidades

- Adicionar e remover itens no carrinho.
- Calcular subtotal dos itens.
- Aplicar regras de pagamento:
  - **Pix**: 10% de desconto.
  - **Cartão à vista**: 10% de desconto.
  - **Cartão parcelado**: Juros compostos de 1% ao mês (até 12x).
- Validação de dados: preço, nome e quantidade dos itens.

---

## Como Rodar

### Requisitos

- Docker
- Docker Compose
- Make (GNU Make)

### Clone o projeto

````bash
git clone https://github.com/Coimbra777/desafio-carrinho-compras.git
``````

---

### Comandos Úteis (`Makefile`)

| Comando     | Descrição                                   |
| ----------- | ------------------------------------------- |
| `make up`   | Sobe os containers Docker                   |
| `make down` | Para e remove os containers                 |
| `make test` | Executa os testes automatizados com PHPUnit |
| `make bash` | Acessa o bash do container da aplicação     |

### Rodando os Testes

```bash
make test
````

### Rodar Testes Manuais

```bash
php tests/test_manual.php
```
