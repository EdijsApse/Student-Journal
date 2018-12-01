<?php

namespace App\Http\Middleware;

use Closure;

class IsCorrectDate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Middleware to check if date is correct
        $date_string = $request->year.'-'.$request->month.'-'.$request->date;
        $date=date_create($date_string);
        if($date == false){
            return redirect('/failed');
        }
        else{
            return $next($request);
        }
    }
}
