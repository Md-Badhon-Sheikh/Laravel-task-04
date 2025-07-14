<?php

namespace App\Http\Controllers\backend\admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminAuthenticationMiddleware;
use App\Http\Middleware\BackendAuthenticationMiddleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

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
        $data['active_menu'] = 'learner_add';
        $data['page_title'] = 'Learner add';
        
        
        $data['messages'] = \App\Models\Learner::all();
        return view('backend.admin.pages.learner_add', compact('data'));

    }

    

    
}
