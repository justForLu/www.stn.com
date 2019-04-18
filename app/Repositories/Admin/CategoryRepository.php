<?php

namespace App\Repositories\Admin;


use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Admin\Category';
    }

}
