<?php
namespace App\Repositories\Admin\Criteria;


use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class CheckContentCriteria extends Criteria {

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

        if(isset($this->conditions['title']) && !empty($this->conditions['title'])){
            $this->conditions['title'] = preg_replace('/( |　|\s)*/','', $this->conditions['title']);
            $model = $model->where('title', 'like','%' . $this->conditions['title'] . '%');
        }elseif(isset($this->conditions['title']) && ($this->conditions['title'] === '0')){
            $model = $model->where('title', 'like','%' . $this->conditions['title'] . '%');
        }

        if(isset($this->conditions['type_first']) && !empty($this->conditions['type_first'])){
            $model = $model->where('type_first', 'like','%' . $this->conditions['type_first'] . '%');
        }

        if(isset($this->conditions['type_second']) && !empty($this->conditions['type_second'])){
            $model = $model->where('type_second', 'like','%' . $this->conditions['type_second'] . '%');
        }

        if(isset($this->conditions['status']) && !empty($this->conditions['status'])){
            $model = $model->where('status', '=',$this->conditions['status']);
        }

        $model = $model->orderBy('id','DESC');

        return $model;
    }
}