<?php

namespace App\Http\Middleware;

use App\Exceptions\GeneralException;
use Closure;

class RouteNeedsPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$permission,$needsAll=false)
    {
        if(strpos($permission,':')){
            $permissions=explode(';',$permission);
            $access=access()->hasPermissions($permissions,$needsAll=='true'?true:false);
        }else{
            $access=access()->hasPermission($permission,$needsAll=='true'?true:false);
        }
        if(!$access){
            echo 'No permission to access Page!';
            exit();
        }
        return $next($request);
    }
}
