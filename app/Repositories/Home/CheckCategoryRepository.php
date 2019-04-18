<?php

namespace App\Repositories\Home;


use App\Repositories\BaseRepository;

class CheckCategoryRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Home\CheckCategory';
    }

}
