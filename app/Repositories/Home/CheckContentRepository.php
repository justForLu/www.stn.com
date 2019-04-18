<?php

namespace App\Repositories\Home;


use App\Repositories\BaseRepository;

class CheckContentRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Home\CheckContent';
    }

}
