<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\User;

class UserController extends BaseController
{
    private $viewPath = 'admin.user';
    public function __construct()
    {
        parent::__construct();
        $this->data['routeType'] = 'user';

    }

    public function index()
    {

        $this->data['users'] = User::whereHas('roles', function ($q) {
            $q->where('name', 'normal');
        })->get();

        return view($this->viewPath . '.view', $this->data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            if ($user->delete()) {
                return redirect()->back()->with('success_message', 'User Deleted Successfully!');

            }

        } catch (\Throwable $th) {
            return redrect()->back()->with('failure_message', 'Something went wrong, please try again!');

        }
    }
}
