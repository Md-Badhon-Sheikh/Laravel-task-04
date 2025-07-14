<?php

namespace App\Http\Controllers\backend\operator;

use App\Http\Controllers\Controller;
use App\Http\Middleware\BackendAuthenticationMiddleware;
use App\Http\Middleware\OperatorAuthenticationMiddleware;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class ImportantLinkController extends Controller implements HasMiddleware
{

 public static function middleware(): array
  {
    return [
      BackendAuthenticationMiddleware::class,
      OperatorAuthenticationMiddleware::class
    ];
  }



    public function important_link_add(){
        return view('backend.operator.pages.important_link_add');
    }
}
