CREATE USER clickhouse_user IDENTIFIED BY 'ClickHouse_123';

GRANT ALL PRIVILEGES ON *.* TO 'clickhouse_user'@'%';

USE test_db;

CREATE TABLE length_content_table(
    date_create DATETIME NOT NULL,
    length_content INTEGER NOT NULL
) ENGINE = InnoDB;

CREATE INDEX length_content_table_index_xx ON length_content_table(date_create, length_content);
