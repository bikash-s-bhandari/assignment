<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;

class AdminController extends BaseController
{

    public function index()
    {
        return view('admin.index');

    }

}
