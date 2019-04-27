<?php

namespace App\Repositories\Home;


use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Home\Product';
    }

}
