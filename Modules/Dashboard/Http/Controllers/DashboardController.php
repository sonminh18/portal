<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\userslist;
use Modules\Permission\Http\Controllers\PermissionChecker as permission;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('dashboard::index');
    }
    public function profile()
    {
        return view('dashboard::profile');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store($array)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('dashboard::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function UpdateInfo(Request $request)
    {
        $userslist = new userslist;
            if($request->has('username')&& $request->has('phonenumber')&& $request->has('email'))
            {
                if($request->hasFile('myimage')){
                    $file = $request->myimage;
                    $filelocation = '/uploads/images/';
                    $file->move(public_path().$filelocation,$file->getClientOriginalName());
                    $filename=$filelocation.$file->getClientOriginalName();
                    $data=$userslist->updateOrCreate(
                        ['username' => $request->get('username')],
                        [
                            'phonenumber' => $request->get('phonenumber'),
                            'email' => $request->get('email'),
                            'image' => $filename
                        ]
                    );
                }
                else{
                    $data=$userslist->updateOrCreate(
                        ['username' => $request->get('username')],
                        [
                            'phonenumber' => $request->get('phonenumber'),
                            'email' => $request->get('email'),
                        ]
                    );
                }
                if($data != null){
                    return response()->json([
                        'Message' => 'Cập nhật thông tin thành công!!',
                        'Status' => '200',
                    ]);
                }
                else{
                    return response()->json([
                        'Message' => 'Cập nhật thông tin thất bại!!',
                        'Status' => '300',
                    ]);
                }
            }
            else
            {
                return response()->json([
                    'Message' => 'Vui lòng nhập đầy đủ thông tin theo yêu cầu!!',
                    'Status' => '300',
                ]);
            }

    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
