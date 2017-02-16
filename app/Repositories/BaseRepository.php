<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2017/2/16
 * Time: 10:41
 */

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{

    /**
     * save
     * @param Model $model
     * @return bool
     */
    public function save(Model $model)
    {
        $saved=$model->save();
        if($saved){
            app('cache')->flush();
        }
        return $saved;
    }

    /**
     * update
     * @param Model $model
     * @param array $input
     * @return bool
     */
    public function update(Model $model,array $input)
    {
        $updated=$model->update($input);
        if($updated){
            app('cache')->flush();
        }
        return $updated;
    }

    /**
     * delete
     * @param Model $model
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Model $model)
    {
        $deleted=$model->delete();
        if($deleted){
            app('cache')->flush();
        }
        return $deleted;
    }

    /**
     * forceDelete
     * @param Model $model
     * @return bool|null
     */
    public function forceDelete(Model $model)
    {
        $deleted=$model->forceDelete();
        if($deleted){
            app('cache')->flush();
        }
        return $deleted;
    }

    /**
     * restore
     * @param Model $model
     * @return mixed
     */
    public function restore(Model $model)
    {
        $deleted=$model->restore();
        if($deleted){
            app('cache')->flush();
        }
        return $deleted;
    }

    /**
     * query
     * @return mixed
     */
    protected function query()
    {
        return call_user_func(static::MODEL.'::query');
    }
}