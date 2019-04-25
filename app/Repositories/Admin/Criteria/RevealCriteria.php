<?php
namespace App\Repositories\Admin\Criteria;


use App\Models\Admin\Manager;
use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class RevealCriteria extends Criteria {

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

        if(isset($this->conditions['author']) && !empty($this->conditions['author'])){
            $model = $model->where('author', 'LIKE', '%'.$this->conditions['author'].'%');
        }

        if(isset($this->conditions['status']) && !empty($this->conditions['status'])){
            $model = $model->where('status', '=',$this->conditions['status']);
        }

        $model = $model->orderBy('id','DESC');

        return $model;
    }
}