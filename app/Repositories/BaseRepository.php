<?php

namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;


abstract class BaseRepository extends Repository
{
    /**
     * 批量插入数据
     * @param $data
     * @return mixed
     */
    public function insertBatch($data){
        return $this->model->insert($data);
    }
}
