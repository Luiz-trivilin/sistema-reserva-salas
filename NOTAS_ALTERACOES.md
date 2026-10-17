# Alterações limitadas à desativação de contas e correções de segurança

- `eliminar_utilizador.php`: desativar/reativar (`valido`), sem apagar utilizador nem reservas.
- `Eliminar_ver.php`: botão desativar/reativar, mantendo o visual existente.
- Login e verificação de sessão: bloquear contas inativas (incluindo sessões anteriormente abertas).
- Apenas administradores gerem contas; professores só podem editar/apagar as próprias reservas; administradores podem gerir reservas.
- Consultas AJAX: validação de parâmetros, autenticação e SQL parametrizado.
- Token CSRF incluído nos formulários de criação, reserva, edição e eliminação.
- A password padrão embutida em `comum.php` foi retirada. Configurar `DB_PASSWORD` no ambiente de execução.
- `sala_livre.sql` inclui `valido`; `migracao_valido.sql` destina-se a bases já existentes.

## Atenção antes de instalar

1. Fazer backup da base de dados. Em instalações antigas executar a migração APENAS se ainda não existir `valido`.
2. Testar login, criação de utilizador, desativação, reativação, marcações, edição e histórico com os três perfis.
3. O SQL do projeto possui nomes de colunas de marcação que precisam de ser confirmados na base efetivamente instalada (`Marcacao` e `data_marcada`). Não foi executada aplicação com MySQL aqui.
4. Não incluir dados reais da escola/contas ou histórico Git antigo no repositório público.
