<?php

namespace App\Repositories\Admin;


use App\Repositories\BaseRepository;

class ContactRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Admin\Contact';
    }

}
