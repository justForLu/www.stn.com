<?php

namespace App\Repositories\Home;


use App\Repositories\BaseRepository;

class CollectionRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Home\Collection';
    }

}
