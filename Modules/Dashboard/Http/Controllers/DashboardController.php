<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Dashboard\Entities\userslist;
use Modules\Bookmarks\Entities\bookmarkpermission;
use Modules\Bookmarks\Entities\bookmarks;
use Modules\Permission\Http\Controllers\PermissionChecker as permission;
use app\helper;
use Modules\Account\Adldap\adldapmodel;

class DashboardController extends Controller
{
    private $helper;
    private $ldap;
    private $bookmark_per;
    private $bookmark;
    public function __construct()
    {
        $this->helper=new helper();
        $this->ldap=new adldapmodel();
        $this->bookmark=new bookmarks();
        $this->bookmark_per=new bookmarkpermission();
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $Group=$this->ldap->getGroupInOU('Users');
        $TeamName=array();
        foreach ($Group as $item){
            if(strpos($item, 'Team')){
                array_push($TeamName,$item);
            }
        }
        $role=session('teamname');
        $dataBookMark= array();
        $i=0;
        foreach ($TeamName as $item){
            $data=$this->bookmark->GetBookMarkByTeamName($item);
            $dataBookMark[$i]['TeamName']=$item;
            $dataBookMark[$i]['bookmark']=array();
            foreach ($data as $value){
                if($value->iShowAll==1){
                    array_push($dataBookMark[$i]['bookmark'],$value);
                }
                else{
                    $CheckPermission=$this->bookmark_per->GetBookMarkPermissionByRole($value->iBookID,$role);
                    if($CheckPermission > 0)
                    {
                        array_push($dataBookMark[$i]['bookmark'],$value);
                    }
                }
            }
            $i++;
        }
        return view('dashboard::index',compact('dataBookMark'));
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
