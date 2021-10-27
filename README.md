# Api Client

<p>Api para gerenciamento de cliente.</p>
<p>Para a utilização do gerenciamento e necessario esta logado.</p>
<p>As informacoes padrão salva do usuário seria</p>
<p>E-mail: password@password.com</p>
<p>Senha: password123</p>

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
