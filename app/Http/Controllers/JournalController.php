<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;

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
    public function add_student(Request $request){
        $response = array(
            'error'=>null,
            'success'=>null
        );
        $student_validation = Validator::make($request->all(),
            [
                'name' => 'required|max:20',
                'surname'=>'required|max:20',
                'email' => 'required|email|max:30',
                'number' => 'nullable|regex:/^(2)[0-9]{7}+$/u',//Starting with 2 followed by 7 digits
                'image'=>'nullable|mimes:jpeg,jpg,png',
            ],
            [
                'name.required'=>'Studenta vārda lauks ir obligāts',
                'name.max'=>'Studenta vārds nedrīkst būt garāks par 20 simboliem',
                'surname.required'=>'Studenta uzvārda lauks ir obligāts',
                'surname.max'=>'Studenta uzvārds nedrīkst būt garāks par 20 simboliem',
                'email.required'=>'Studenta epasta lauks ir obligāts',
                'email.email'=>'Studenta epasta adrese nav derīga',
                'email.max'=>'Studenta epasta adrese nedrīkst būt garāka par 30 simboliem',
                'number.regex'=>'Studenta telefona numuram jāsatur 8 ciparus un jāsākās ar 2',
                'image.mimes'=>'Studenta attēlam jābūt ar .jpeg, .jpg vai .png paplašinājumu'
            ]
        );
        if ($student_validation->fails()) {
            $response['error'] = $student_validation->errors()->first();
            return json_encode($response, JSON_UNESCAPED_UNICODE);
        }
        else{
            $response['success'] = 'Good to go';
            return json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    }
}
