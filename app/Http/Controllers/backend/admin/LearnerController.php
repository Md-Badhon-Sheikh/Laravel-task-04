<?php

namespace App\Http\Controllers\backend\admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminAuthenticationMiddleware;
use App\Http\Middleware\BackendAuthenticationMiddleware;
use App\Models\Learner;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use PDOException;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class LearnerController extends Controller implements HasMiddleware
{
       public static function middleware()
    {
        return [
            BackendAuthenticationMiddleware::class,
            AdminAuthenticationMiddleware::class
        ];
    }


    public function learner_add(Request $request){
 
        $data = [];
        if($request->isMethod('post')){
            $photo = $request->file('photo');
            if($photo){
                $photo_extension = $photo->getClientOriginalExtension();
                $photo_name = 'backend_assets/images/learner/'.uniqid().'.'.$photo_extension;
                $image = Image::make($photo);
                // $image->resize(300,300);
                $image->save($photo_name);
            }else{
                $photo_name = null;
            }

               // cv upload
            $cv_file = $request->file('cv');
            if ($cv_file) {
                $cv_extension = $cv_file->getClientOriginalExtension();
                $cv_name = 'backend_assets/cv/'.uniqid().'.'.$cv_extension;
                $cv_file->move(public_path('backend_assets/cv'), basename($cv_name));
            } else {
                $cv_name = null;
            }
            try{
                Learner::create([
                    'name' => $request-> name,
                    'phone' => $request-> phone,
                    'country' => $request-> country,
                    'email' => $request-> email,
                    'password' => $request-> password,
                    'gender' => $request-> gender,
                    'learner_type' => $request-> learner_type,
                    'highest_degree' => $request-> highest_degree,
                    'position' => $request-> position,
                    'company_name' => $request-> company_name,
                    'experience_year' => $request-> experience_year,
                    'photo' =>  $photo_name,
                    'latest_cv' => $cv_name,
                    'training_details' => $request-> training_details,
                    'achievements' => $request-> achievements,
                    'research_paper' => $request-> research_paper,
                    'present_address' => $request-> present_address,
                    'parmanent_address' => $request-> parmanent_address,
                    'country_visited' => $request-> country_visited,
                    'bio' => $request-> bio,
                    
                    'created_by' => Auth::user()->id,
                ]);
                return back()->with('success', 'Added Successfully');
            }catch(PDOException $e){
                return back()->with('error', 'Failed Please Try Again'.$e->getMessage());
            }
        }
        $data['active_menu'] = 'learner_add';
        $data['page_title'] = 'Learner Add';
        return view('backend.admin.pages.learner_add', compact('data'));

    }

    public function learner_list(){
        $data = [];
        $data['learner_list'] = DB::table('learners')->get();
        $data['active_menu'] = 'learner_list';
        $data['page_title'] = 'Learner List';
        return view('backend.admin.pages.learner_list', compact('data'));

    }

    public function downloadPdf(){
        $data['learner_list'] = DB::table('learners')->get();
        $pdf = Pdf::loadView('backend.admin.pages.learner_pdf', compact('data'))->setPaper('legal', 'landscape');
        return $pdf->download('learner.pdf');

    }
}
