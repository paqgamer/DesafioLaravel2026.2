<p align="center"><a href="https://codejr.com.br/" target="_blank"><img src="https://media.licdn.com/dms/image/v2/C4D0BAQGilICPiM6Bkw/company-logo_200_200/company-logo_200_200/0/1630557110913/code_empresa_jnior_logo?e=2147483647&v=beta&t=f17s92wFR-yqeZqt-X9L7QRwCLk4kkjw2OTW4tpa_uI" width="250" alt="Code"></a></p>

<h1 align="center">
    Desafio Laravel 2026.2
</h1>

## Sobre o desafio

O desafio tem como intuito treinar os novos membros da Code Jr., afim de familiarizarem melhor com o framework Laravel desenvolvendo um e-commerce de produtos eletrônicos, com as funcionalidades definidas no documento de requisitos disponibilizado.
## Como executar o projeto (Laravel Sail)

### Pré-requisitos
- Docker -  instala e executa, no  meu é systemctl start docker
- Git  - obviamente

### Passo a passo

1. Clona esse repo e  entre na pasta::
```bash
   git clone <https://github.com/paqgamer/DesafioLaravel2026.2>
   cd <DesafioLaravel2026.2>
```

2. Copie o arquivo `.env.example` e renomeie sua cópia para `.env`:
```bash
   cp .env.example .env
```

3. **Se for a primeira vez rodando o projeto** (não vai ter  a pasta `vendor/`), instala as paradas do php  para que`sail` fique disponível depois desse passo:
```bash
   docker run --rm \
       -u "$(id -u):$(id -g)" \
       -v "$(pwd):/var/www/html" \
       -w /var/www/html \
       laravelsail/php84-composer:latest \
       composer install --ignore-platform-reqs
```

4. No `.env`, tem  que estar nesse modelo pra comunicar com  o  banco de dados:
```
   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=sail
   DB_PASSWORD=password
```
Ajuste  portas como necessário pra rodar em cada máquina, talvezs seu computador já estejausando  alguma delas

5. Pra rodar os containers:
```bash
   ./vendor/bin/sail up -d
```

 Eu recomendo fortemente cirar um alias mo arquivo  do shell, no meu caso  o zshrc, coloque "alias sail='vendor/bin/sail'" e  aí dá pra usar apenas o  comando sail como se fosse  o do php

6. gerar a chave:
```bash
   sail artisan key:generate
```

7. Usar a migration  e semear o banco:
```bash
   sail artisan migrate --seed
```

8. Pra funcionar as coisas do storage, o navegador  poder acessar lá:
```bash
   sail artisan storage:link
```

9. Coisa do vite(eu acho):
```bash
   sail npm install
   sail npm run build
```
   Depois toda vez que  executar  tenha um terminal com  "npm  run dev" aberto.

10. acesse  "localhost"  no navegador, simples  assim.

### Observações

depois de semear o banco, logue com admin padrão "bagre@admin.com" senha: 123123. Depois  mude  isso se quiser.
Troquei o  phpmyadmin pelo adminer, muito melhor