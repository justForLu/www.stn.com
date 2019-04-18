<?php
namespace App\Repositories\Admin\Criteria;


use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class CheckCategoryCriteria extends Criteria {

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

        if(isset($this->conditions['parent']) && !empty($this->conditions['parent'])){
            $this->conditions['parent'] = preg_replace('/( |　|\s)*/','', $this->conditions['parent']);
            $model = $model->where('parent', '=', $this->conditions['parent']);
        }else{
            $model = $model->where('parent', '=', 0);
        }

        if(isset($this->conditions['name']) && !empty($this->conditions['name'])){
            $this->conditions['name'] = preg_replace('/( |　|\s)*/','', $this->conditions['name']);
            $model = $model->where('name', 'like','%' . $this->conditions['name'] . '%');
        }elseif(isset($this->conditions['name']) && ($this->conditions['name'] === '0')){
            $model = $model->where('name', 'like','%' . $this->conditions['name'] . '%');
        }

        if(isset($this->conditions['status']) && !empty($this->conditions['status'])){
            $model = $model->where('status', '=',$this->conditions['status']);
        }

        $model = $model->orderBy('sort','ASC');
        $model = $model->orderBy('id','DESC');

        return $model;
    }
}