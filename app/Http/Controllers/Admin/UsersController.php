<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Kodeine\Acl\Models\Eloquent\Role;
use Illuminate\Support\Facades\Auth;
use App\Helper\Custom;
/**
 * Class UsersController for CRUD operation of users.
 *
 * Author : Prajakta Sisale.
 */
class UsersController extends Controller
{
    /**
     *
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $usersData = array();
        $result = array();

        if($request->ajax()) {

            $totalRecords=User::count();
            $limit=$request->input('length');
            if($limit == -1){
                $limit = $totalRecords;
            }
            $offset=$request->input('start');
            $search=$request->input('search');
            $search_word=trim($search['value']);
            $draw = $request->input('draw');
            $column = $request->input('columns');
            $order = $request->input('order');
            $sortBy = $order[0]['column'];
            $sortOf = $order[0]['dir'];
            $name = $column[$sortBy]['data'];
            $email = $column[$sortBy]['data'];
            $role = $column[$sortBy]['data'];

            $usersData = User::with('role');

            if ($search_word != '' ) {

                $usersData ->where('first_name', 'LIKE', "%$search_word%")
                    ->orWhere('last_name', 'LIKE', "%$search_word%")
                    ->orWhere('email', 'LIKE', "%$search_word%")
                    ->orWhere('role_id', 'LIKE', "%$search_word%");

            }

            $usersData=$usersData->skip($offset)
                   ->take($limit)
                   ->orderBy($name , $sortOf)
                   ->orderBy($email, $sortOf)
                   ->orderBy($role, $sortOf)
                   ->get();
            if ($search_word != '' ) {
                $recordsFiltered = $usersData->count();
                $recordsTotal = $usersData->count();

            }else{
                $recordsFiltered = User::count();
                $recordsTotal = User::count();
            }

            $final = array();
            foreach($usersData as $key => $val){
                $res_data = array();
                $res_data['id'] = $val['id'];
                $res_data['first_name'] = $val['first_name'];
                $res_data['last_name'] = $val['last_name'];
                $res_data['email'] = $val['email'];
                $res_data['role_id'] = $val['role']['name'];
                $final[] = $res_data;
            }

            $result['draw'] = $draw;
            $result['recordsFiltered'] = $recordsFiltered;
            $result['recordsTotal'] = $recordsTotal;
            $result['data'] =   $final;


          return $result;
        }
        $authUser = Auth::user();
        return view('admin.users.index', array('authUser'=>$authUser,'usersData'=>$usersData));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {


        $roles = Role::with('users')->get();

        $authUser = Auth::user();

        return view('admin.users.create',array('authUser'=>$authUser,'roles'=> $roles));
    }

    /**
     * Store a newly created user in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'min:8|max:12|alpha_num|required',
            'status' => 'required',
            'role_id' => 'required'
        ]);

        $requestData = $request->all();
        Hash::make($requestData['password']);
        User::create($requestData);

        return redirect('admin/users')->with('flash_message', 'User added!');
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $roles = User::with('role')->get();

        $user = User::findOrFail($id);

        $authUser = Auth::user();

        return view('admin.users.show', compact('user','authUser','roles'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {

        $authUser = Auth::user();
        $user = User::findOrFail($id);
        Hash::make($user['Password']);
/*        $roles=User::get();*/
        $roles = Role::with('users')->get();

        return view('admin.users.edit',array('authUser'=>$authUser,'roles'=> $roles,'user'=>$user));
    }

    /**
     * Update the specified user in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'min:8|max:12|required|alpha_num',
            'status' => 'required',
            'role_id' => 'required'
        ]);

        $requestData = $request->all();
        $user = User::findOrFail($id);
        $user->update($requestData);

        return redirect('admin/users')->with('flash_message', 'User updated!');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {

        User::destroy($id);

        return redirect('admin/users')->with('flash_message', 'User deleted!');
    }
}