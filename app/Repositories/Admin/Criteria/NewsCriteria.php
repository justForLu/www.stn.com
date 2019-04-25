<?php
namespace App\Repositories\Admin\Criteria;


use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class NewsCriteria extends Criteria {

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

        if(isset($this->conditions['author']) && !empty($this->conditions['author'])){
            $model = $model->where('author', 'like','%' . $this->conditions['author'] . '%');
        }

        if(isset($this->conditions['type']) && !empty($this->conditions['type'])){
            $model = $model->where('type', '=',$this->conditions['type']);
        }

        if(isset($this->conditions['status']) && !empty($this->conditions['status'])){
            $model = $model->where('status', '=',$this->conditions['status']);
        }

        $model = $model->orderBy('id','DESC');

        return $model;
    }
}