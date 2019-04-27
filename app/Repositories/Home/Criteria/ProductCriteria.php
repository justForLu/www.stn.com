<?php
namespace App\Repositories\Home\Criteria;


use App\Enums\BasicEnum;
use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class ProductCriteria extends Criteria {

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
        if(isset($this->conditions['name']) && !empty($this->conditions['name'])){
            $model = $model->where('name', 'LIKE', '%'.$this->conditions['name'].'%');
        }

        if(isset($this->conditions['type']) && !empty($this->conditions['type'])){
            $model = $model->where('type', '=',$this->conditions['type']);
        }

        $model = $model->where('status', '=',BasicEnum::ACTIVE);

        $model = $model->orderBy('id','DESC');

        return $model;
    }
}