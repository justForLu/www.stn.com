<?php

namespace App\Repositories\Home;


use App\Repositories\BaseRepository;

class RevealRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Home\Reveal';
    }

}
