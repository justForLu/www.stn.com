<?php

namespace App\Repositories\Admin;


use App\Repositories\BaseRepository;

class RevealRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Admin\Reveal';
    }

}
