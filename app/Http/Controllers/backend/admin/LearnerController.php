<?php

namespace App\Http\Controllers\backend\admin;

use App\Exports\LearnersExport;
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
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class LearnerController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            BackendAuthenticationMiddleware::class,
            AdminAuthenticationMiddleware::class
        ];
    }


    public function learner_add(Request $request)
    {

        $data = [];
        if ($request->isMethod('post')) {
            $photo = $request->file('photo');
            if ($photo) {
                $photo_extension = $photo->getClientOriginalExtension();
                $photo_name = 'backend_assets/images/learner/' . uniqid() . '.' . $photo_extension;
                $image = Image::make($photo);
                // $image->resize(300,300);
                $image->save($photo_name);
            } else {
                $photo_name = null;
            }

            // cv upload
            $cv_file = $request->file('latest_cv');
            if ($cv_file) {
                $cv_extension = $cv_file->getClientOriginalExtension();
                $latest_cv = 'backend_assets/cv/' . uniqid() . '.' . $cv_extension;
                $cv_file->move(public_path('backend_assets/cv'), basename($latest_cv));
            } else {
                $latest_cv = null;
            }
            try {
                Learner::create([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'country' => $request->country,
                    'email' => $request->email,
                    'password' => $request->password,
                    'gender' => $request->gender,
                    'learner_type' => $request->learner_type,
                    'highest_degree' => $request->highest_degree,
                    'position' => $request->position,
                    'company_name' => $request->company_name,
                    'experience_year' => $request->experience_year,
                    'photo' =>  $photo_name,
                    'latest_cv' => $latest_cv,
                    'training_details' => $request->training_details,
                    'achievements' => $request->achievements,
                    'research_paper' => $request->research_paper,
                    'present_address' => $request->present_address,
                    'parmanent_address' => $request->parmanent_address,
                    'country_visited' => $request->country_visited,
                    'bio' => $request->bio,

                    'created_by' => Auth::user()->id,
                ]);
                return back()->with('success', 'Added Successfully');
            } catch (PDOException $e) {
                return back()->with('error', 'Failed Please Try Again' . $e->getMessage());
            }
        }
        $data['active_menu'] = 'learner_add';
        $data['page_title'] = 'Learner Add';
        return view('backend.admin.pages.learner_add', compact('data'));
    }

    public function learner_list()
    {
        $data = [];
        $data['learner_list'] = DB::table('learners')->get();
        $data['active_menu'] = 'learner_list';
        $data['page_title'] = 'Learner List';
        return view('backend.admin.pages.learner_list', compact('data'));
    }

    // pdf Download 
    public function downloadPdf()
    {
        $data['learner_list'] = DB::table('learners')->get();
        $pdf = Pdf::loadView('backend.admin.pages.learner_pdf', compact('data'))->setPaper('legal', 'landscape');
        return $pdf->download('learner.pdf');
    }

    // excel download 

    public function exportLearners(){
        //  $data['learner_list'] = DB::table('learners')->get();
          return Excel::download(new LearnersExport, 'learners.xlsx');
    }

    // edit function 

    public function learner_edit(Request $request, $id)
    {
        $data = [];
        $data['learner'] = Learner::findOrFail($id);
        if ($request->isMethod('post')) {
            $old_photo = $data['learner']->photo;
            $photo = $request->file('photo');
            if ($photo) {
                $photo_extension = $photo->getClientOriginalExtension();
                $photo_name = 'backend_assets/images/learner/' . uniqid() . '.' . $photo_extension;

                $photo->move(public_path('backend_assets/images/learner'), basename($photo_name));

                if (File::exists($old_photo)) {
                    File::delete($old_photo);
                }
            } else {
                $photo_name = $old_photo;
            }

            // cv edit 
            $old_cv = $data['learner']->latest_cv;
            $cv_file = $request->file('latest_cv');
            if ($cv_file) {
                $cv_extension = $cv_file->getClientOriginalExtension();
                $latest_cv = 'backend_assets/cv/' . uniqid() . '.' . $cv_extension;
                $cv_file->move(public_path('backend_assets/cv'), basename($latest_cv));

               
                if (File::exists($old_cv)) {
                    File::delete($old_cv);
                }
            } else {
                $latest_cv = $old_cv;
            }

            if ($request->name) {
                $name = bcrypt($request->name);
            } else {
                $name = $data['learner']->name;
            }
            if ($request->phone) {
                $phone = bcrypt($request->phone);
            } else {
                $phone = $data['learner']->phone;
            }
            if ($request->country) {
                $country = bcrypt($request->country);
            } else {
                $country = $data['learner']->country;
            }
            if ($request->email) {
                $email = bcrypt($request->email);
            } else {
                $email = $data['learner']->email;
            }
            if ($request->password) {
                $password = bcrypt($request->password);
            } else {
                $password = $data['learner']->password;
            }
            if ($request->gender) {
                $gender = bcrypt($request->gender);
            } else {
                $gender = $data['learner']->gender;
            }
            if ($request->learner_type) {
                $learner_type = bcrypt($request->learner_type);
            } else {
                $learner_type = $data['learner']->learner_type;
            }
            if ($request->highest_degree) {
                $highest_degree = bcrypt($request->highest_degree);
            } else {
                $highest_degree = $data['learner']->highest_degree;
            }
            if ($request->position) {
                $position = bcrypt($request->position);
            } else {
                $position = $data['learner']->position;
            }
            if ($request->company_name) {
                $company_name = bcrypt($request->company_name);
            } else {
                $company_name = $data['learner']->company_name;
            }
            if ($request->experience_year) {
                $experience_year = bcrypt($request->experience_year);
            } else {
                $experience_year = $data['learner']->experience_year;
            }

            if ($request->training_details) {
                $training_details = bcrypt($request->training_details);
            } else {
                $training_details = $data['learner']->training_details;
            }
            if ($request->achievements) {
                $achievements = bcrypt($request->achievements);
            } else {
                $achievements = $data['learner']->achievements;
            }
            if ($request->research_paper) {
                $research_paper = bcrypt($request->research_paper);
            } else {
                $research_paper = $data['learner']->research_paper;
            }
            if ($request->present_address) {
                $present_address = bcrypt($request->present_address);
            } else {
                $present_address = $data['learner']->present_address;
            }
            if ($request->parmanent_address) {
                $parmanent_address = bcrypt($request->parmanent_address);
            } else {
                $parmanent_address = $data['learner']->parmanent_address;
            }
            if ($request->country_visited) {
                $country_visited = bcrypt($request->country_visited);
            } else {
                $country_visited = $data['learner']->country_visited;
            }
            if ($request->bio) {
                $bio = bcrypt($request->bio);
            } else {
                $bio = $data['learner']->bio;
            }
            try {
                $data['learner']->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'country' => $request->country,
                    'email' => $request->email,
                    'password' => $request->password,
                    'gender' => $request->gender,
                    'learner_type' => $request->learner_type,
                    'highest_degree' => $request->highest_degree,
                    'position' => $request->position,
                    'company_name' => $request->company_name,
                    'experience_year' => $request->experience_year,
                    'photo' =>  $photo_name,
                    'latest_cv' => $latest_cv,
                    'training_details' => $request->training_details,
                    'achievements' => $request->achievements,
                    'research_paper' => $request->research_paper,
                    'present_address' => $request->present_address,
                    'parmanent_address' => $request->parmanent_address,
                    'country_visited' => $request->country_visited,
                    'bio' => $request->bio,
                ]);
                return back()->with('success', 'Updated Successfully');
            } catch (PDOException $e) {
                return back()->with('error', 'Failed Please try Again');
            }
        }
        $data['active_menu'] = 'learner_edit';
        $data['page_title'] = 'Learner Edit';
        return view('backend.admin.pages.learner_edit', compact('data'));
    }


    // delete function 
    public function learner_delete($id)
    {
        $server_response = ['status' => 'FAILED', 'message' => 'Not Found'];
        $learner = Learner::findOrFail($id);
        if ($learner) {
            if (File::exists($learner->photo)) {
                File::delete($learner->photo);
            }
            $learner->delete();
            $server_response = ['status' => 'SUCCESS', 'message' => 'Deleted Successfully'];
        } else {
            $server_response = ['status' => 'FAILED', 'message' => 'Not Found'];
        }
        echo json_encode($server_response);
    }
}
