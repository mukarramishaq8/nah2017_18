<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\EducationalI;
use App\School;
use App\Discipline;
class EducationalController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('checkEducationalStage');
     }

    public function index(Request $request){
        $user = Auth::user();
        if($user){
            $schools = School::all();
            $disciplines = Discipline::all();
            $educationalI = $user->educationalI()->get();
            if($educationalI && count($educationalI) > 0){
                $educationalI = $educationalI[0];
            }
            else{
                $educationalI = new EducationalI;
            }
            return view('educationalInformation')->with('schools',$schools)->with('disciplines',$disciplines)->with('educationalI',$educationalI);
        }
        else{
            return redirect()->route('login')->with('type','error')->with('msg','Session expired. Login to continue');
        }
    }


    public function save(Request $request)
    {
        $user = Auth::user();
        //if session is active
    	if($user){
            $data = (object) array(
                'user_id'=>$user->id,
                'reg_no'=> $request->input('nustRegistrationNumber'),
                'degree'=> $request->input('degreeName'),
                'school'=> $request->input('school'),
                'discipline'=> $request->input('discipline'),
                'enrollment_year'=> $request->input('enrollmentYear'),
                'graduation_year'=> $request->input('graduationYear'),
                'has_alumni_card'=> $request->input('alumniCard'),
            );
            //check if user has an entry of educational information in database
            //if yes
            $educationalI = $user->educationalI()->get();
            
            
            if($educationalI && count($educationalI) > 0){
                $educationalI = $educationalI[0];
               $educationalI->reg_no = $data->reg_no;
               $educationalI->degree = $data->degree;
               $educationalI->school = $data->school;
               $educationalI->discipline = $data->discipline;
               $educationalI->enrollment_year = $data->enrollment_year;
               $educationalI->graduation_year = $data->graduation_year;
               $educationalI->has_alumni_card = $data->has_alumni_card;
                //save to database
                $educationalI->save();

                return \Response::json(['type'=>'success','msg'=>'Data saved successfully.']);
            }
            else{
                $educational = EducationalI::create((array)$data);
                return \Response::json(['type'=>'success','msg'=>'Data saved successfully.']);
            }

            return \Response::json(['type'=>'error','msg'=>'Unknown error while saving data. Please try again.']);
            
        }
        else{
            //either session is expired or page is directly being accessed so stop it
            return \Response::json(['type'=>'error','msg'=>'Your session is expired. Please login to continue']);
        }
    	

    }


    public function saveAndNext(Request $request){
        $user = Auth::user();
        //if session is still active
        if($user){

            $data = (object)array(
                'user_id'=>$user->id,
                'reg_no'=> $request->input('nustRegistrationNumber'),
                'degree'=> $request->input('degreeName'),
                'school'=> $request->input('school'),
                'discipline'=> $request->input('discipline'),
                'enrollment_year'=> $request->input('enrollmentYear'),
                'graduation_year'=> $request->input('graduationYear'),
                'has_alumni_card'=> $request->input('alumniCard'),
            );
            //check if user has educationalInformation entry in table already or not
            $educationalI = $user->educationalI()->get();
            
            
            if($educationalI && count($educationalI) > 0){
                $educationalI = $educationalI[0];
                //then update
                $educationalI->reg_no = $data->reg_no;
                $educationalI->degree = $data->degree;
                $educationalI->school = $data->school;
                $educationalI->discipline = $data->discipline;
                $educationalI->enrollment_year = $data->enrollment_year;
                $educationalI->graduation_year = $data->graduation_year;
                $educationalI->has_alumni_card = $data->has_alumni_card;
                //save to database
                $educationalI->save();

                $stage = $user->stage()->get();
                if($stage && count($stage)>0){
                    $stage = $stage[0];
                    $stage->is_educational_info_done = true;
                    $stage->save();
                }
                else{
                    $stage = Stage::create(array(
                        'user_id'=>$user_id,
                        'is_educational_info_done'=>true,
                    ));
                }

                return redirect()->route('professionalInformation')->with('type','success')->with('msg','Educational Information saved successfully.');
                
            }
            else{
                //otherwise create one
                $personal = EducationalI::create((array)$data);
                $stage = $user->stage()->get();
                if($stage && count($stage)>0){
                    $stage = $stage[0];
                    $stage->is_educational_info_done = true;
                    $stage->save();
                }
                else{
                    $stage = Stage::create(array(
                        'user_id'=>$user_id,
                        'is_educational_info_done'=>true,
                    ));
                }
                return redirect()->route('professionalInformation')->with('type','success')->with('msg','Educational Information saved successfully.');
                
            }

            return redirect()->back()->with('type','error')->with('msg','Unknow error. Please try again.');

        }
        else{
            //session is expired
            return redirect()->route('login')->with('type','error')->with('msg','Session expired. Login to continue');
        }

    }
}
