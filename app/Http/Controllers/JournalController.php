<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Intervention\Image\ImageManagerStatic as Image;//Composer require intervention/image <--uzstādīšana

use File;

use Validator;

use App\Students;

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
                'email' => 'required|email|max:30|unique:st_students',
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
                'email.unique'=>'Students ar šādu e-pasta adresi jau ir pievienots',
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
            $student_values = array(
                'name'=> $request->input('name'),
                'surname'=>$request->input('surname'),
                'email'=>$request->input('email'),
                'number'=>$request->input('number')
            );
            if($request->hasFile('image')){
                $image = Image::make($request->file('image'));
                $image_dimensions = getimagesize($request->file('image'));
                if($image_dimensions[0] < 800){//Width<800
                    $image_file = $image;
                }
                else{
                    $image_file = $image->resize(800, null, function ($constraint) {//width 800 height auto keeping ratio
                        $constraint->aspectRatio();
                    });
                }
                $image_id = 0;
                $image_type = $image_dimensions['mime'];// is array of image/jpg or other format
                $image_type_arr = explode("/",$image_type);//Need to split so we can get jpg which will be 2nd element in array
                $file_name = 'user_image_' . $image_id. '.' .$image_type_arr[1];
                while(File::exists('images/'.$file_name)){//If file exists
                    $image_id++;
                    $file_name = 'user_image_' . $image_id. '.' .$image_type_arr[1];
                }
                if($image_file->save('images/'.$file_name)){//If file is saved successfuly
                    $student_values['image'] = 'images/'.$file_name;
                }
            }
            $response['success'] = 'Students izveidots';
            return json_encode($response, JSON_UNESCAPED_UNICODE);
        }

    }
}
