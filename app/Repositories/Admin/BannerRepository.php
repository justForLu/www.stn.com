<?php

namespace App\Repositories\Admin;


use App\Repositories\BaseRepository;

class BannerRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Admin\Banner';
    }

}
