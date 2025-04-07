<?php

namespace Auth\Domain\Models;

use Nurymbet\Flux\Model;

class BlackList extends Model
{
    protected static string $table = 'jwt_black_list';
}
