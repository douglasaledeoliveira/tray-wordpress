# Prova Prática para Programador PHP II (WordPress)

## Parte 1 - Aplicação Base

### Instruções

1. **Instalação do WordPress**: Realize a instalação da versão mais recente do WordPress. Versão utilizada: 6.3.1.
2. **Tema**: Selecione e instale um tema gratuito. Tema utilizado: Astra
3. **Posts**: Crie e insira alguns posts; é possível utilizar os Blogs da Tray para copiar o conteúdo diretamente. 
4. **Apresentação da Página**: Adicione informações para tornar a página inicial mais atraente.

### Plugins Utilizados

- API Produtos Tray - Por Douglas Aleluia de Oliveira
- All-in-One WP Migration
- Contact Form 7
- Elementor - Free Version
- Elementor Header & Footer Builder
- Wordfence Security
- WP Fastest Cache
- Yoast SEO

### Recursos

- [Escola Tray](https://www.tray.com.br/escola/)
- [Blog Tray](https://blog.tray.com.br/)

## Parte 2 - Desenvolvimento de Plugin

### Sobre o Plugin

O plugin lista produtos de uma loja Tray na página inicial do blog. Utilizamos a API pública da Tray para importar os produtos para o blog.

### Configuração

No painel administrativo do plugin, inclua um campo para inserir a URL da API pública de produtos de uma loja Tray.

#### Exemplos de endpoints:

- [Go Fashion](https://demo-go-fashion.commercesuite.com.br/web_api/products)
- [Moda Fit](https://demo-moda-fit.commercesuite.com.br/web_api/products)
- [Playground](https://demo-playground.commercesuite.com.br/web_api/products)
- [Autoparts Store](https://demo-autoparts-store.commercesuite.com.br/web_api/products)
- [Go Decor](https://demo-go-decor.commercesuite.com.br/web_api/products)

### Funcionalidades

- Mostra um bloco de produtos no front-end.
- Registra cliques nos produtos.
- Exibe a contagem de cliques para cada produto no painel de administração do WordPress.

## Observações

- O projeto deve ser hospedado no GitHub e o link deve ser fornecido.
- A hospedagem do projeto é opcional.
- A organização e a performance do código serão avaliadas.

## Projeto Hospedado

O projeto está hospedado em [https://testetray.douglasaoliveira.com.br](https://testetray.douglasaoliveira.com.br).

## Referências

- [Escrevendo Plugin para WP](https://codex.wordpress.org/pt-br:Escrevendo_um_Plugin)
- [Documentação API Tray](https://developers.tray.com.br/#api-de-produtos)
