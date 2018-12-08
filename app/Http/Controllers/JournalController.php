<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Intervention\Image\ImageManagerStatic as Image;//Composer require intervention/image <--uzstādīšana

use File;

use Validator;

use App\Students;

use App\Lectures;

use App\Attendance;

class JournalController extends Controller
{

    private $month_notations_for_menu = ['Janvāris', 'Februāris', 'Marts', 'Aprīlis','Maijs','Jūnījs', 'Jūlījs', 'Augusts', 'Septembris', 'Oktobris', 'Novembris', 'Decembris'];
    
    private function add_student_attencane($student, $value, $lecture){//Function to add student attendance 
        $db_student = Students::where([
            'id'=>$student['value'],
            'surname'=>$student['surname']
        ])->first();//Checking if student with with that id and surname exists
        if(!empty($db_student)){
            Attendance::create([
                'lecture'=>$lecture->id,
                'student'=>$student['value'],
                'value'=>$value
            ]);
        }
        else{//If db_student will be empty it means someone is trying to add nonexisting student
            return false;
        }
    }
    private function validate_attendance_arrays($attendance_array, $value, $lecture){//Function to check if array of students 
        //attendance_array = arrays from request
        //value = 1/0 (what will go in db based on array type(visited/skiped))
        //lecture = lecture that was added in db
        if(is_array($attendance_array) == true){//If attendance array is array
            foreach($attendance_array as $student){
                $is_student_attendance_added = $this->add_student_attencane($student, $value, $lecture);
            }
        }
        else{
            return false;//Wasn't array and attendance rows in attendance table isn't created
        }
    }
    private function validate_date($date){
        $is_valid_date = date_create($date);
        if($is_valid_date == false){
            return false;//If date is invalid, return false - throw 404
        }
        else{
            return true;
        }
    }
    private function update_student_views($id){
        $student = Students::where('id', $id)->first();
        Students::where('id', $id)->update([
            'views'=>$student->views + 1
        ]);
    }



    public function get_todays_visit(){
        $todays_year = date('Y');
        $todays_month = date('m');
        $todays_date = date('d');
        return redirect('/calendar/'.$todays_year.'-'.$todays_month.'-'.round($todays_date));//Redirect to todays visit
    }
    //All get_lectures functions as well as visit views/blades are almost exact !!!need to optimize!!!!
    public function get_date_lectures($year, $month, $date){
        $date_to_test = $year.'-'.$month.'-'.$date;
        $is_valid_date = $this->validate_date($date_to_test);
        if($is_valid_date == false){
            return redirect('/404');
        }
        $lecture = Lectures::where('date',$year.'-'.$month.'-'.$date)
                        ->orderBy('id','desc')
                        ->paginate(3);
        $url_month = $this->month_notations_for_menu[$month - 1];
        $date = round($date);
        session(['date' => $year.'-'.$month.'-'.$date]);//Noseto sesiju, tādējādi, kad izveidos lekciju, zinās kādā datumā
        return view('visit')
            ->with('year', $year)
            ->with('month', $month)
            ->with('url_month', $url_month)
            ->with('date', $date)
            ->with('lectures', $lecture);
    }
    public function get_months_lectures($year, $month){
        $date = $year.'-'.$month;
        $is_valid_date = $this->validate_date($date);
        if($is_valid_date == false){
            return redirect('/404');
        }
        $lecture = Lectures::select('*')//Select all where date starts with year-month
                            ->where('date', 'like', '%'.$year.'-'.$month.'%')
                            ->orderBy('id','desc')
                            ->paginate(3);
        $url_month = $this->month_notations_for_menu[$month - 1];
        return view('month-visit')
            ->with('year', $year)
            ->with('month', $month)
            ->with('url_month', $url_month)
            ->with('lectures', $lecture);
    }
    public function get_year_lectures($year){
        $date = $year;
        $is_valid_date = $this->validate_date($date);
        if($is_valid_date == false){
            return redirect('/404');
        }
        $lecture = Lectures::select('*')//Select all where date starts with year
                            ->where('date', 'like', '%'.$year.'%')
                            ->orderBy('id','desc')
                            ->paginate(3);
        return view('year-visit')
            ->with('year', $year)
            ->with('lectures', $lecture);
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
            $created_student = Students::create($student_values);
            if(!empty($created_student)){
                $response['success'] = 'Students izveidots! Pārlādē lapu lai apskatītu!';
                return json_encode($response, JSON_UNESCAPED_UNICODE);
            }
            else{
                $response['error'] = 'Students netika izveidots';
                return json_encode($response, JSON_UNESCAPED_UNICODE);
            }
        }

    }
    public function add_lecture(Request $request){
        $response = array(
            'error'=>null,
            'success'=>null
        );
        $lecture_validation = Validator::make($request->all(),
            [
                'title' => 'required|max:40',
                'description'=>'required|max:300',
            ],
            [
                'title.required'=>'Lekcijas nosaukuma lauks ir obligāts',
                'title.max'=>'Lekcijas nosaukuma lauka garums pārsniedz 40 simbolus',
                'description.required'=>'lekcijas apraksta laukam jābūt aizpildītam',
                'description.max'=>'Lekcijas apraksts ir par garu (nedrīkst būt garāks par 300 simboliem)',
            ]
        );
        if ($lecture_validation->fails()) {
            $response['error'] = $lecture_validation->errors()->first();
            return json_encode($response, JSON_UNESCAPED_UNICODE);
        }
        else{//if validation is passed
            $lecture = Lectures::create([
                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'date'=>session('date')
            ]);//Lecture created
            $skiped_array_validation = $this->validate_attendance_arrays($request->input('skiped'),0, $lecture);
            $visited_array_validation = $this->validate_attendance_arrays($request->input('visited'),1, $lecture);
            if($skiped_array_validation && $visited_array_validation == true){
                $response['success'] = 'Lekcija un apmeklējums izveidots!';
                return json_encode($response, JSON_UNESCAPED_UNICODE);
            }
            else{
                $response['success'] = 'Lekcija izveidota! Pārlādē lapu lai to apskatītu!';
                return json_encode($response, JSON_UNESCAPED_UNICODE);
            }
        }
    }
    public function get_all_lectures(){
        $lectures = Lectures::orderBy('date','desc')->paginate(3);
        return view('lectures')->with('lectures', $lectures);
    }
    public function get_all_students(){
        $students = Students::orderBy('name','asc')->paginate(12);
        return view('students')->with('students', $students);
    }
    public function get_specific_student($id){
        $this->update_student_views($id);
        $student = Students::where('id', $id)->first();
        if(empty($student)){
            return redirect('/404');
        }
        $attendance = Attendance::where(['student'=>$id,'value'=>1])->get();
        $lectures = Lectures::all();
        if(count($attendance) != 0){
            $student_attendance = count($attendance)/count($lectures);
            $attendance_percent = round($student_attendance*100, 2);
        }
        else{
            $attendance_percent = 0;
        }
        return view('student')->with('student', $student)->with('attendance', $attendance_percent);
    }
}
