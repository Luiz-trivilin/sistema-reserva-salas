# Alterações limitadas desta versão

- `ajax/buscar_horarios.php`: `Marcacao` -> `data_marcada`.
- `sala_livre.sql`: remove coluna antiga `Marcacao` e define chave primária em `id` + unicidade da sala/horário/data.
- `editar_ver.php`: impede professor de abrir página de edição de reservas alheias usando ID alterado; corrige listagem de professores ativos.
- `Historico.php` e `ver_marcacao.php`: corrige comparação de tipos devolvidos pelo MySQL; histórico mantém professores desativados para consulta.
- `comum.php`: remove password por defeito do código versionado; permite ficheiro `config.local.php` local ignorado pelo Git.
- `.gitignore`, `.env.example`, `config.local.example.php`, `README.md`: instruções da configuração sem segredos e tipo correto de administrador (0).
- `MIGRACAO_DATA_MARCADA.md`: instruções para rever manualmente a BD existente, sem alterar automaticamente os dados.

Não foram feitos testes integrados com o AMPPS/MySQL do utilizador.
