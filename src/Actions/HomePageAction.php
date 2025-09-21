<?php

namespace App\Actions;

use Psa\Qb\Db;

class HomePageAction
{
    public function run(Db $db)
    {
        return [
            'title' => 'Home Page',
            // 'users' => $db->from('accounts')->all(),
        ];
    }
}
