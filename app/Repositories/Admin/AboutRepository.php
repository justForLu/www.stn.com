<?php

namespace App\Repositories\Admin;


use App\Repositories\BaseRepository;

class AboutRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Admin\About';
    }

}
