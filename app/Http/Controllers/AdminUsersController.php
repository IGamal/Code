<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\User;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $input = $request->all();

        if ($file = $request->file('photo_path'))
        {

            $name = time() . '_' . rand(0, 1000) . '.' . $file->getClientOriginalExtension() ;
            $file->move('images', $name);

            $input['photo_path'] = $name;
        }

        $input['password'] = bcrypt($request->password);

        User::create($input);

        Session()->flash('add_admin','Admin '. $input['name'] . ' has been Added successfully');

        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findorFail($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, $id)
    {
        $input = $request->all();

        if ($file = $request->file('photo_path'))
        {

            $name = time() . '_' . rand(0, 1000) . '.' . $file->getClientOriginalExtension() ;
            $file->move('images', $name);

            $input['photo_path'] = $name;
        }

        $input['password'] = bcrypt($request->password);

        $user = User::FindorFail($id);

        $user->update($input);

        Session()->flash('update_admin','Admin '. $user->name . ' has been Updated successfully');

        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete(Request $request)
    {
        $users = User::FindorFail($request->checkBoxArray);

        if(empty($request->checkBoxArray))
        {
            return redirect()->back();
        }
        else
        {
            foreach ($users as $user) {
                $photo = str_replace($user->path, '', $user->photo_path);

                if (!empty($photo)) {
                    if (file_exists(public_path($user->photo_path))) {
                        unlink(public_path($user->photo_path));
                    }
                }

                $user->delete();

                Session()->flash('delete_admin', 'Admin ' . $user->name . ' has been Deleted successfully');
            }

            return redirect()->back();
        }

        return redirect()->back();
    }
}
