<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JournalController extends Controller
{
    private $month_notations = ['Janvāris', 'Februāris', 'Marts', 'Aprīlis','Maijs','Jūnījs', 'Jūlījs', 'Augusts', 'Septembris', 'Oktobris', 'Novembris', 'Decembris'];
    public function get_todays_visit(){
        $todays_year = date('Y');
        $todays_month = date('m');
        $todays_date = date('d');
        return redirect($todays_year.'-'.$todays_month.'-'.$todays_date);//Redirect to todays visit
    }
    public function get_visit($year, $month, $date){
        $months_name = $this->month_notations[$month - 1];
        $date = round($date);
        return view('visit')
            ->with('year', $year)
            ->with('month', $month)
            ->with('months_name', $months_name)
            ->with('date', $date);
    }
}
