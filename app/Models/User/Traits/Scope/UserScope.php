<?php
/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2017/2/17
 * Time: 10:39
 */

namespace App\Models\User\Traits\Scope;


trait UserScope
{
    public function scopeActive($query,$status)
    {
        return $query->where('status',$status);
    }
}