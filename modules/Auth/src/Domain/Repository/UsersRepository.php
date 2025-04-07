<?php

namespace Auth\Domain\Repository;

use Auth\Domain\Models\Users;

class UsersRepository extends Users
{
    /**
     * Для создание пользователя
     *
     * @param array $data
     * @return array
     */
    public static function set(array $data): array
    {
        return static::create($data)::flush();
    }
}
