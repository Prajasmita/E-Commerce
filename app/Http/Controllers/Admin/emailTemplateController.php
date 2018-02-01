<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Custom;
use App\Http\Requests;

/**
 * Class BannersController for CRUD operation of banner images.
 *
 * Author : Prajakta Sisale.
 */
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class emailTemplateController extends Controller
{

    public function emailTemplate(){

        $authUser = Auth::user();
        return view('email_template',array('authUser'=>$authUser));

    }

}