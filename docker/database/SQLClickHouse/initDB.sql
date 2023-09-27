CREATE DATABASE db1_mysql
    ENGINE = MaterializedMySQL(
    'db',
    'db1',
    'clickhouse_user',
    'ClickHouse_123'
    );
