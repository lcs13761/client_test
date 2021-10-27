# Api Client

<p>Api para gerenciamento de cliente.</p>
<p>Para a utilização do gerenciamento e necessario esta logado.</p>
<p>As informacoes padrão salva do usuário.</p>
<p>E-mail: password@password.com</p>
<p>Senha: password123</p>


## Banco de dados

<p>As configurações do banco de dados é feito no .Env</p>
<p>Na pasta database/migrations possui os dados das tabelas que precisam ser criadas</p>
<p>Na pasta database/seeders possui os dados basicos que serao registrado.</p>
<p>Para a criação do banco de dados na pasta da aplicação ,faça a execução no terminal do comando <b>php artisan migrate:f --seed.</b></p>
<p>Apos a execução do comando a estrutura sera criada é ficara pronta para utilização.</p>

### Tabelas no Banco de dados
<p>A aplicação possui 3 tabelas.</p>
<p>Users</p>
<p>Client</p>
<p>Address</p>

<p>Users --ligação--> Client</p>
<p>Address ---ligação--> Client e Users</p>


## Rotas

### Rotas de Autenticação do usuário 

<p>Route /api/login ,Metodo Post</p>
<p>Route /api/logout ,Metodo Post, Observação:requirido esta logado</p>
<p>Route /api/refresh ,Metodo Post, Observaçãorequirido esta logado</p> 

### Rotas para Usuário logado

<p>Route /api/user Metodo GET</p>
<p>Route /api/update Metodo PUT</p>

### Rotas para Client 

<p>Route /api/clients Metodo GET</p>
<p>Route /api/client/add Metodo POST</p>
<p>Route /api/client/update/{id} Metodo PUT</p>
<p>Route /api/client/delete/{id} Metodo DELLETE</p>

### Inicar a Aplicação.

<p>Para iniciar projeto, e necessario esta na pasta da aplicação, apos isso adicione no terminal o comando <b>php artisan serve</b> e aperte enter.</p>
