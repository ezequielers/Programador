# Programador Laravel
Segue abaixo uma história de usuário que deverá ser baseada para o desenvolvimento da solução utilizando Laravel (PHP). Não há certo ou errado, analise pensando nas necessidades a serem contempladas computacionalmente, trazendo a solução que achar mais viável.
Será avaliado a lógica utilizada, simplicidade do código, documentação do código, organização e identação do código e conhecimento em técnicas avançadas de programação.

## User Story
Como responsável por uma empresa de gerenciamento de projetos eu gostaria de controlar de forma simples todos os projetos da companhia. Os projetos terão um número ilimitado de empregados associados a eles, sendo que um empregado pode ser Gerente ou Funcionário. Cada gerente tem alguns funcionários. Os dados básicos dos projetos são descrição e deadline (Data Inicio e Fim). 

Crie um projeto de Api usando a última versão disponível do Laravel (https://laravel.com/docs), a resposta dos Controllers deve ser um JSON, cria as Rotas, Models, Requests e Resources ou Services necessários para criar empregados e projetos e listar os projetos existentes.

## Instalação do ambiente para uso da aplicação

Para que seja possível o uso do backend será necessário o uso do Docker, para que o ambiente seja emulado corretamente e suba todos os seus recursos, como NGinx, MySQL, PHP-Fpm e Laravel.

## Instalação do Docker
Para instalar o Docker basta baixar do site oficial do [Doker](https://hub.docker.com/?overlay=onboarding).

##Configuração do Docker para uso do ambiente
Para que usar o ambiente será necessário estar no diretório `backend\docker` e executar o seguinte comando:
```
docker-compose up -d
```
Irá começar a instalação dos pacotes e e configuração do ambiente para o uso dos serviços.
Ao término será exibido um resultado semelhante ao abaixo:
```
Creating network "docker_app-network" with driver "bridge"
Creating webserver ... done
Creating app       ... done
Creating db        ... done 
```

Após o passo anterior será necesário a execução dos seguintes comandos:
Instalar as dependencias para o o uso da aplicação (composer)
```
docker-compose exec app composer install
```
Gerar nova Key para o Laravel
```
docker-compose exec app php artisan key:generate
```
Limpar o cache para o uso
```
docker-compose exec app php artisan config:cache
```