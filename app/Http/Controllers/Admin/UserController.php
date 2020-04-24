<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
            $users = User::orderBy('updated_at', 'desc')->paginate(5);
            return view('admins.user.user', compact('users'));
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
         [
            'name'         => 'required|max:255|min:5',
            'email'   => 'required|email|unique:users,email',
            'password'   =>  'required|min:8',
            'avatar' => 'required|image|max:2000',
         ],
         [
            'required' => ':attribute Không được để trống',
            'min' => ':attribute Không được nhỏ hơn :min ký tự',
            'max' => ':attribute Không được lớn hơn :max ký tự',
            'unique' => 'email này đã được sử dụng',
        ],
        
    );
        if ($validator->passes()) {
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $namefile = $avatar->getClientOriginalName();
                $url = 'storage/avatar/' . $namefile;
                Storage::disk('public')->putFileAs('avatar', $avatar, $namefile);
            } else {
                echo 'Lỗi';
            }
            $user = new User();
            $user->avatar = $url;
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->phone = $request->get('phone');
            $user->password = bcrypt($request->get('password'));
            $user->created_at=\Carbon\Carbon::now('Asia/Ho_Chi_Minh');
            $user->updated_at=\Carbon\Carbon::now('Asia/Ho_Chi_Minh');
            $save = $user->save();

			return response()->json(['success'=>'Added new records.']);
        }


    	return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userEdit=User::find($id);
        return view('admins.user.include.editUser', compact('userEdit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user=user::find($request->get('id'));
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $namefile = $avatar->getClientOriginalName();
            $url = 'storage/avatar/' . $namefile;
            Storage::disk('public')->putFileAs('avatar', $avatar, $namefile);
            $user->avatar=$url;
        } else {
            echo 'Lỗi';
        }
        
        
        $user->name=$request->get('nameEdit');
        $user->address=$request->get('address');
        $user->password=bcrypt($request->get('passwordEdit'));
        $user->phone=$request->get('phoneEdit');
        $user->updated_at=\Carbon\Carbon::now('Asia/Ho_Chi_Minh');
        $save=$user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
