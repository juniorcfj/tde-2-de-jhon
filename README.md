# Sistema de Gerenciamento de Companhia de Ônibus

Este é um sistema básico de gerenciamento de uma companhia de ônibus, implementado em PHP, que inclui classes para representar motoristas, passageiros, ônibus, rotas e a própria companhia de ônibus.

## Funcionalidades

- Criação e gestão de motoristas, passageiros, ônibus e rotas.
- Alocamento de ônibus para rotas específicas.
- Compra e cancelamento de bilhetes pelos passageiros.
- Início e fim de viagens pelos motoristas.
- Relato de problemas com os ônibus pelos motoristas.

## Estrutura do Código

- `Pessoa`: Classe abstrata que define atributos e métodos compartilhados entre motoristas e passageiros.
- `Motorista`: Classe que representa os motoristas, com métodos para iniciar e finalizar viagens, relatar problemas e visualizar rotas.
- `Passageiro`: Classe que representa os passageiros, com métodos para comprar e cancelar bilhetes.
- `Onibus`: Classe que representa os ônibus, com métodos para alterar o estado e obter o estado atual do ônibus.
- `Rota`: Classe que representa as rotas, com métodos para adicionar e remover ônibus e horários.
- `Bilhete`: Classe que representa os bilhetes comprados pelos passageiros, com método para cancelar o bilhete.
- `CompaniaDeOnibus`: Classe que representa a companhia de ônibus, com métodos para adicionar e remover ônibus, rotas e motoristas.

## Utilização

- Crie instâncias de motoristas, passageiros, ônibus e rotas.
- Adicione os motoristas, passageiros e ônibus à companhia de ônibus.
- Atribua ônibus às rotas específicas.
- Permita que os passageiros comprem e cancelem bilhetes.
- Permita que os motoristas iniciem e finalizem viagens, relatem problemas e visualizem rotas.


