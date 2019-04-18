<?php
namespace App\Repositories\Admin\Criteria;


use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class ConfigCriteria extends Criteria {

    private $conditions;

    public function __construct($conditions){
        $this->conditions = $conditions;
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {

        if(isset($this->conditions['status']) && !empty($this->conditions['status'])){
            $model = $model->where('status', '=',$this->conditions['status']);
        }

        $model = $model->orderBy('id','DESC');

        return $model;
    }
}