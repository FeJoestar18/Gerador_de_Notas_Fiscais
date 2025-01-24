# Gerador_de_Notas_Fiscais
"This project is an easy-to-use invoice generator that simplifies the creation and management of invoices for businesses. Users can input company name, customer details, payment method, and total amount. The invoices can be customized and exported in PDF format, streamlining the invoicing process."

# Como Rodar o Projeto em PHP

## Requisitos

1. **Servidor local:** XAMPP ou WAMP.
   - Se estiver usando XAMPP, coloque os arquivos na pasta `htdocs`.
   - Se estiver usando WAMP, coloque os arquivos na pasta `www`.

2. **PHP:** Versão compatível com o projeto.

3. **Composer:** Gerenciador de dependências PHP.

4. **Node.js:** Para usar o Cypress e outras dependências JavaScript.

5. **Banco de Dados MySQL:** Deve estar ativo para conectar ao projeto.

## Passos para Configurar o Projeto

### 1. Clonar o Repositório

Abra o terminal e execute o comando:
```bash
git clone <URL_DO_REPOSITORIO>
```
Substitua `<URL_DO_REPOSITORIO>` pelo link do repositório Git.

### 2. Mover os Arquivos

- Se estiver usando **XAMPP**:
  - Mova os arquivos para a pasta `htdocs`.
- Se estiver usando **WAMP**:
  - Mova os arquivos para a pasta `www`.

### 3. Instalar Dependências PHP

Navegue até a pasta do projeto no terminal e execute:
```bash
composer install
```
Isso instalará as dependências definidas no arquivo `composer.json`, como:
- `tecnickcom/tcpdf`
- `picqer/php-barcode-generator`

### 4. Instalar Dependências JavaScript

Execute o comando para instalar as dependências do arquivo `package.json`:
```bash
npm install
```
Isso instalará pacotes como:
- `@faker-js/faker`
- `cypress`
- `lodash`

### 5. Configurar o Banco de Dados

1. Acesse o phpMyAdmin pelo navegador:
   - **XAMPP:** [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
   - **WAMP:** [http://localhost/phpmyadmin](http://localhost/phpmyadmin)

2. Crie um banco de dados com o nome `gerador-v1`.

3. Certifique-se de que as credenciais do banco de dados no arquivo `conexao.php` são:
   ```php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $database = "gerador-v1";
   ```

4. Importe o arquivo SQL, se houver, para configurar as tabelas e dados iniciais.

### 6. Ligar o Servidor Local

1. Abra o painel do XAMPP ou WAMP.
2. Inicie os serviços de **Apache** e **MySQL**.

### 7. Acessar o Projeto

No navegador, digite o seguinte:
- **XAMPP:** [http://localhost/pasta-do-projeto](http://localhost/pasta-do-projeto)
- **WAMP:** [http://localhost/pasta-do-projeto](http://localhost/pasta-do-projeto)

Substitua `pasta-do-projeto` pelo nome da pasta onde colocou os arquivos.

## Rodar Testes com Cypress

1. Para abrir o Cypress, execute:
   ```bash
   npx cypress open
   ```
2. Escolha os testes desejados e execute-os na interface do Cypress.

## Problemas Comuns

1. **Erro de Conexão com o Banco de Dados:**
   - Verifique se o MySQL está rodando.
   - Confirme se as credenciais no `conexao.php` estão corretas.

2. **Dependências Não Instaladas:**
   - Execute novamente `composer install` e `npm install`.

3. **Permissão de Pasta:**
   - Certifique-se de que o servidor local tem permissão para acessar a pasta do projeto.

Agora o projeto está pronto para ser usado!

