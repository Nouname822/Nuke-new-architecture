<?php

namespace Auth\Database\Migrations;

use Nurymbet\Flux\Migrations;

return new class('users') extends Migrations
{
    public function up(): string
    {
        return "
            CREATE TABLE {$this->table} (
                id SERIAL PRIMARY KEY,
                login VARCHAR(255) UNIQUE NOT NULL,
                email VARCHAR(255) UNIQUE NOT NULL,
                avatar VARCHAR(255) NOT NULL DEFAULT '/assets/img/profile.svg',
                name VARCHAR(255) NOT NULL DEFAULT 'Иван Иванов',
                password VARCHAR(255) NOT NULL,
                failed_login INT NOT NULL DEFAULT 0,
                status TEXT CHECK (status IN ('active', 'inactive')) NOT NULL,
                role TEXT NOT NULL,
                last_login TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL
            )
        ";
    }

    public function down(): string
    {
        return "
            DROP TABLE {$this->table}
        ";
    }
};
