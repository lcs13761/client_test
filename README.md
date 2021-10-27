# Api Client

<p>Api para gerenciamento de cliente.</p>
<p>Para a utilização do gerenciamento e necessario esta logado.</p>
<p>As informacoes padrão salva do usuário seria</p>
<p>E-mail: password@password.com</p>
<p>Senha: password123</p>


## Banco de dados


<p>As configurações do banco de dados e feito no .Env</p>
<p>Na pasta database/migrations possui os dados das tabelas que precisam ser criadas</p>
<p>Na pasta database/seeders possui os dados basicos registrado que serao registrado.</p>
<p>Para a criação  do banco de dados rote no terminal, na pasta da aplicação #### php artisan migrate:f --seed.</p>
<p>Apos rota o comando a estrutura sera criada e ficara pronta para uso.</p>

### Tabelas no Banco de dados
<p>A aplicação possui 3 tabelas.</p>
<p>Users</p>
<p>Client</p>
<p>Address</p>

<p>Users esta conectado a Address e a Cliente. onde o usuario pode ter varios clientes.</p>
<p>Users e clients possui uma conexão onde um usuário possui apenas 1 endereço. </p>


## Rotas

### Autenticação do usuário 

<p>/api/login</p>
<p>/api/logout  requirido esta logado</p>
<p>/api/refresh requirido esta logado</p> 

### Usuário logado

<p>/api/user Metodo GET</p>
<p>/api/update Metodo PUT</p>

### Client 

<p>/api/clients Metodo GET</p>
<p>/api/client/add Metodo POST</p>
<p>/api/client/update/{id} Metodo PUT</p>
<p>/api/client/delete/{id} Metodo DELLETE</p>
