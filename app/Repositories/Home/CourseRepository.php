<?php

namespace App\Repositories\Home;


use App\Repositories\BaseRepository;

class CourseRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Home\Course';
    }

}
