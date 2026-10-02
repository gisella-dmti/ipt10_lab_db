# mysqli vs PDO Comparison Notes

| Area | mysqli | PDO |
|---|---|---|
| Error handling | The project enables strict mysqli reporting so database failures throw `mysqli_sql_exception`. | The project uses `PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION`, so database failures throw `PDOException`. |
| Prepared statements | Parameters are bound separately with `bind_param()`, and the type string must match the supplied values. | Parameters are supplied through the `execute([...])` array, so there is no separate `bind_param()` call. |
| Default fetch mode | The code explicitly uses `mysqli_fetch_assoc()` to obtain associative rows. | The configuration sets `PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC`, so `fetch()` returns associative rows by default. |
| Transaction support | mysqli supports transactions, but this activity's Part 1 does not require manual transaction control. | The activity explicitly requires manual transaction control by disabling autocommit. Successful writes therefore call `commit()`, while failed writes can call `rollBack()`. |
| Database portability | mysqli is designed for MySQL/MariaDB. | PDO provides one API for several database drivers, so changing the database driver can be easier when the SQL is compatible. |
| Attribute configuration | Behavior is configured through mysqli functions/methods such as `mysqli_report()` and `set_charset()`. | PDO exposes several connection attributes for errors, fetching, emulated prepares, string conversion, and autocommit. |
