# Migração da base de dados existente (AMPPS / phpMyAdmin)

**Não importar `sala_livre.sql` por cima da tua base de dados em utilização.** O ficheiro SQL da distribuição serve para criar uma base nova.

O nome atual da coluna de data é `data_marcada`; `Marcacao` era o nome antigo. Antes de alterar índices, **faz uma cópia de segurança**.

1. No phpMyAdmin, confirma as colunas e índices atuais usando `SHOW CREATE TABLE marcacao;`.
2. Verifica se existem reservas duplicadas:

```sql
SELECT id_sala, id_horario, data_marcada, COUNT(*) AS total
FROM marcacao
GROUP BY id_sala, id_horario, data_marcada
HAVING COUNT(*) > 1;
```

3. Se aparecerem linhas, resolve esses conflitos primeiro, sem apagar reservas automaticamente.
4. Se a base atual **ainda tiver** a coluna `Marcacao` e o índice principal usar essa coluna, há que migrar a chave cuidadosamente. No esquema fornecido no ZIP, a alteração apropriada para uma BD sem duplicados é:

```sql
ALTER TABLE marcacao
  DROP PRIMARY KEY,
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY uq_reserva_sala_horario_data (id_sala, id_horario, data_marcada);
```

5. Só depois de confirmares que já não há código nem índices a usar `Marcacao`, podes remover a coluna antiga:

```sql
ALTER TABLE marcacao DROP COLUMN Marcacao;
```

**Atenção:** não executar os comandos sem confirmar o esquema real! Se `id` já for chave primária ou o índice único já existir, adapta o comando em vez de o executar novamente. Se `Marcacao` já tiver sido removida, não executar o último comando.
