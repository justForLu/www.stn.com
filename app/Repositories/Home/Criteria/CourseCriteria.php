<?php
namespace App\Repositories\Home\Criteria;

use App\Enums\BasicEnum;
use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class CourseCriteria extends Criteria {

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
        $model = $model->where('status', '=',BasicEnum::ACTIVE);
        $model = $model->orderBy('is_top','DESC');
        $model = $model->orderBy('sort','ASC');
        $model = $model->orderBy('id','DESC');

        return $model;
    }
}