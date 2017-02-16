<?php
namespace App\Repositories;
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2017/2/16
 * Time: 10:40
 */
class Repository extends BaseRepository
{

    /**
     * getAll
     * @return mixed
     */
    public function getAll()
    {
        return $this->query()->get();
    }

    /**
     * getCount
     * @return mixed
     */
    public function getCount()
    {
        return $this->query()->count();
    }

    /**
     * find
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->query()->find($id);
    }
}