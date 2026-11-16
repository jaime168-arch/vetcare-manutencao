# VetCare — Sistema de Gestão Veterinária

Sistema web desenvolvido em PHP e MySQL/MariaDB para gerenciamento de clínicas veterinárias, contemplando o controle de tutores, animais, consultas e central de chamados de suporte. Projeto aplicado à disciplina de **Manutenção de Sistemas**, com foco na correção de falhas, segurança de dados e melhorias de interface.

---

## Requisitos do Ambiente

- **Servidor Web:** XAMPP (Apache + MySQL/MariaDB)
- **Linguagem:** PHP 8.0 ou superior com extensão PDO habilitada
- **Navegador:** Google Chrome, Mozilla Firefox, Microsoft Edge ou similar

---

## Instalação e Configuração

1. Copie a pasta `vetcare_manutencao` para o diretório público do XAMPP (`C:\xampp\htdocs\`).
2. Abra o painel de controle do XAMPP e inicie os serviços **Apache** e **MySQL**.
3. Acesse o phpMyAdmin (`http://localhost:8080/phpmyadmin` ou `http://localhost/phpmyadmin`).
4. Crie um banco de dados chamado `vetcare` (collation `utf8mb4_unicode_ci`) e importe o arquivo `database/vetcare.sql`.
5. Confira os parâmetros de conexão no arquivo `config/database.php` (ou `config/conexao.php`), ajustando host, porta (`3306`), usuário (`root`) e senha conforme o seu ambiente local.
6. Abra o sistema no navegador pelo endereço:
   `http://localhost:8080/jaime_rodrigues_2026/vetcare_manutencao/` *(ajuste a porta ou pasta raiz conforme a configuração do seu Apache)*.

### Credenciais de Acesso Padrão
- **Usuário:** `admin`
- **Senha:** `admin123`

> **Aviso:** Este projeto foi estruturado para fins acadêmicos em ambiente local. Não utilize dados pessoais ou clínicos reais nem exponha a aplicação diretamente em servidores públicos sem revisão completa de segurança.

---

## Funcionalidades do Sistema

- **Autenticação:** Controle de sessão com login e logout obrigatórios para acesso às rotas internas.
- **Painel Principal (Dashboard):** Visão geral com indicadores rápidos de cadastros e atendimentos.
- **Gestão de Tutores:** Cadastro, edição, listagem, exclusão com confirmação e busca por nome completo ou parcial, com identificação visual de status (`Ativo` / `Inativo`).
- **Gestão de Animais:** Controle completo de pacientes vinculados aos respectivos tutores, com cálculo de idade e validação de integridade na exclusão.
- **Agenda de Consultas:** Registro e acompanhamento de atendimentos veterinários, com filtro dinâmico por status (`Agendada`, `Realizada`, `Cancelada`) e etiquetas visuais.
- **Central de Suporte:** Abertura de chamados técnicos com registro de passos para reprodução, severidade, prioridade, atribuição de responsável e histórico de comentários.

---

## Manutenções e Melhorias Implementadas

Durante a etapa de manutenção corretiva e evolutiva do sistema, foram realizadas as seguintes intervenções:

- **Navegação e Estilo (`includes/header.php`):** Ajuste dinâmico dos caminhos relativos para carregamento da folha de estilo (`assets/style.css`) e links de menu a partir de qualquer subpasta, além de destaque visual na aba ativa.
- **Módulo de Tutores (`tutores/index.php`):** Remoção do bloqueio em JavaScript no botão de novo cadastro, correção da consulta SQL para considerar o nome completo na pesquisa, adição de confirmação na exclusão e botão para limpeza de filtro.
- **Módulo de Animais (`animais/excluir.php`):** Inclusão da cláusula `WHERE id = ?` na instrução `DELETE` e tratamento de exceções de chave estrangeira para impedir exclusões indevidas ou erros fatais quando houver consultas vinculadas.
- **Módulo de Consultas (`consultas/index.php`):** Implementação do filtro por status na consulta SQL utilizando *prepared statements* e inclusão de badges coloridas para facilitar a leitura da agenda.
- **Interface e Experiência de Uso (`assets/style.css` e `includes/footer.php`):** Reestruturação do CSS com variáveis de tema, estados de foco nos formulários, tabelas com linhas alternadas e padronização do rodapé.

---

## Estrutura de Diretórios

```text
vetcare_manutencao/
├── animais/          # Listagem, formulário e exclusão de pacientes
├── assets/           # Folha de estilos global (style.css)
├── chamados/         # Central de suporte e histórico de ocorrências
├── config/           # Configuração de banco de dados (PDO) e controle de sessão
├── consultas/        # Agendamento, listagem com filtro e edição de consultas
├── database/         # Script SQL com estrutura das tabelas e dados iniciais
├── includes/         # Componentes reutilizáveis (header.php e footer.php)
├── tutores/          # Gerenciamento e busca de responsáveis
├── index.php         # Dashboard principal
├── login.php         # Tela de autenticação
├── logout.php        # Encerramento de sessão
└── README.md         # Documentação do projeto