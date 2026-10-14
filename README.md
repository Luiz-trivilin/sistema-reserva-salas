# Sistema de Gestão e Reserva de Salas

Projeto de Aptidão Profissional (PAP) desenvolvido no curso profissional de Gestão e Programação de Sistemas Informáticos.

## Sobre
Aplicação web de gestão e marcação de salas, com login, calendário, perfis de utilizador e consulta/gestão de reservas.

## Tecnologias
PHP, MySQL (PDO), JavaScript, HTML, CSS, Bootstrap e jQuery.

## Funcionalidades presentes no código
- Autenticação com `password_verify()` e sessão PHP;
- Consulta do calendário e horários;
- Criação, edição e remoção de reservas;
- Gestão de utilizadores e histórico.

## Como executar localmente
1. Instalar PHP 8.x com extensão `pdo_mysql` e MySQL 8.x (ou ambiente local equivalente).
2. Criar uma base de dados chamada `sala_livre` e importar `sala_livre.sql`.
3. Configurar as variáveis de ambiente `DB_HOST`, `DB_NAME`, `DB_USER` e `DB_PASSWORD` (consultar `.env.example`). O ficheiro `.env.example` é documentação; a aplicação **não carrega automaticamente** um ficheiro `.env`.
4. Iniciar o servidor local na pasta do projeto, por exemplo `php -S localhost:8000`, e abrir `http://localhost:8000/_index.php`.
5. Criar um utilizador inicial no MySQL com uma password gerada por `php -r 'echo password_hash("ALTERAR_PASSWORD", PASSWORD_DEFAULT), PHP_EOL;'`; atribuir `tipo=2` para administrador. Nunca reutilizar passwords de produção.

## Preparação para GitHub
O histórico `.git` antigo e os registos originais da base de dados não fazem parte desta cópia. As credenciais foram substituídas por variáveis de ambiente, e vários acessos SQL passaram a usar parâmetros.

## Limitações / segurança
Esta é uma **versão de portfólio académico, não auditada para produção**. Foi feita uma revisão estática e verificação de sintaxe, mas **não foram executados testes de ponta a ponta com MySQL**. Antes de disponibilizar a aplicação publicamente, rever todas as rotas AJAX, validar permissões por função, adicionar proteção CSRF nos formulários, testar regras de agendamento, tratar erros, rever a exposição de dados e realizar testes de segurança.

## Autor
Luiz Trivilin — Projeto académico (PAP).
