<?php

namespace App\Repositories\Admin;


use App\Repositories\BaseRepository;

class ConfigRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Admin\Config';
    }

}
