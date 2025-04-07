<?php

namespace Auth\Database\Migrations;

use Nurymbet\Flux\Migrations;

return new class('jwt_black_list') extends Migrations
{
    public function up(): string
    {
        return "
            CREATE TABLE {$this->table} (
                id SERIAL PRIMARY KEY,
                token TEXT UNIQUE NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                CONSTRAINT token_unique UNIQUE (token)
            );
            CREATE INDEX token_idx ON {$this->table} (token);
        ";
    }

    public function down(): string
    {
        return "
            DROP TABLE {$this->table}
        ";
    }
};
