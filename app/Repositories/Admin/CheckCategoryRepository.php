<?php

namespace App\Repositories\Admin;


use App\Repositories\BaseRepository;

class CheckCategoryRepository extends BaseRepository
{
    public function model()
    {
        return 'App\Models\Admin\CheckCategory';
    }

    public function updatePath($parent,$id){
        if($parent==0){
            $path=[
                'path' => ',0,'.$id.',',
                'grade' => 1,
            ];
        }else{
            $higher=$this->model->where('id', $parent)->first();
            $path=[
                'path' => $higher['path'].$id.',',
                'grade' => $higher['grade']+1,
            ];
        }
        return $this->model->where('id', $id)->update($path);
    }
}
