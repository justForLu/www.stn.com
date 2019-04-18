<?php

namespace App\Repositories\Admin;


use App\Repositories\BaseRepository;

class CourseRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Admin\Course';
    }

}
