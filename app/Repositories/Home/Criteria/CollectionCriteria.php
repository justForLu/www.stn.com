<?php
namespace App\Repositories\Home\Criteria;

use App\Enums\BasicEnum;
use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class CollectionCriteria extends Criteria {

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
        if(isset($this->conditions['user_id']) && !empty($this->conditions['user_id'])){
            $model = $model->where('user_id', '=',$this->conditions['user_id']);
        }

        $model = $model->orderBy('id','DESC');

        return $model;
    }
}


