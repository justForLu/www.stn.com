<?php

namespace App\Repositories\Admin;


use App\Repositories\BaseRepository;

class CheckContentRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Admin\CheckContent';
    }

}
