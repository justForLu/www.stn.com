<?php
namespace App\Repositories\Home\Criteria;

use App\Enums\BasicEnum;
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
        $model = $model->where('status', '=',BasicEnum::ACTIVE);
        //发布时间小于现在这个时间点
        $model = $model->where('gmt_release', '<=',get_date());

        $model = $model->orderBy('is_top','DESC');
        $model = $model->orderBy('gmt_create','DESC');

        return $model;
    }
}


