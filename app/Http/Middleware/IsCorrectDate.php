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
        //!!!!MIddleware not in use!!!!
        //Middleware to check if date is correct
        //Ienākošais requests skries cauri visiem trim ifiem, kamēr aprausies (ja būs derīgs datums)
        if(isset($request->year)){
            $date_string = $request->year;
            $date=date_create($date_string);
        }
        if(isset($request->month)){
            $date_string = $request->year.'-'.$request->month;
            $date=date_create($date_string);
        }
        if(isset($request->date)){
            $date_string = $request->year.'-'.$request->month.'-'.$request->date;
            $date=date_create($date_string);
        }
        if($date == false){
            return redirect('/failed');
        }
        else{
            return $next($request);
        }
    }
}
