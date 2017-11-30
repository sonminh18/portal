<?php

namespace Modules\Login\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

use Adldap\AdldapInterface;
use Adldap\Connections\ConnectionInterface;

class LoginController extends Controller
{
    /**
     * @var Adldap
     */
    protected $adldap;

    /**
     * Constructor.
     *
     * @param AdldapInterface $adldap
     */
    public function __construct(AdldapInterface $adldap)
    {
        $this->adldap = $adldap;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if(session()->has('username') && session()->has('password')){
            return redirect('/dashboard');
        }
        else{
            return view('login::index');
        }
    }
    public function signin(Request $request){
        if($request->has('username') &&  $request->has('password')){
            $username=$request->input('username');
            $password=$request->input('password');
            if($this->authentication($username,$password)){
                $data=$this->adldap->search()->users()->find($username);
                $dn=explode(',',$this->adldap->search()->users()->find($username)->getDn());
                $dn=explode('=',$dn[1]);
                $cn=$dn[1];
                if(count($data['memberof']) > 0){
                    $memberof=explode(",",$this->customSearch('Team',$data['memberof']));
                    $member=explode("=",$memberof[0]);
                    $deptnameof=explode(",",$this->customSearch('Dept',$data['memberof']));
                    $deptname=explode("=",$deptnameof[0]);
                    $teamname=$member[1];
                }else{
                    $teamname='No Group Name';
                }
                session(['username' => $username]);
                session(['password' => $password]);
                session(['fullname' => $data['displayname'][0]]);
                session(['teamname' => $teamname]);
                session(['deptname' => $cn ]);
                return response()->json([
                    'Message' => 'Đăng nhập thành công!!!',
                    'Status' => '200',
                ]);
            }
            else{
                return response()->json([
                    'Message' => 'Đăng nhập thất bại, thông tin đăng nhập không chính xác!!',
                    'Status' => '300',
                ]);
            }
        }else{
            return response()->json([
                'Message' => 'Tên đăng nhập và Mật khẩu không được để trống!!!',
                'Status' => '300',
            ]);
        }
    }
    public function signout(){
        session()->flush();
        session()->regenerate();
        return redirect('/');
    }
    function customSearch($keyword, $arrayToSearch){
        foreach($arrayToSearch as $key => $arrayItem){
            if( stristr( $arrayItem, $keyword ) ){
                return $arrayItem;
            }
        }
    }

    public function authentication($user,$password){
        $request=$this->adldap->getProvider('default')->auth()->attempt($user, $password);
        if($request == 1){
            return true;
        }else{
            return false;
        }
    }

    public function changepassword(Request $request){
        if($request->has('username') &&  $request->has('password') && $request->has('newpassword') &&  $request->has('newpasswordrepeat')) {
            if ($request->input('newpassword') != $request->input('newpasswordrepeat')) {
                return response()->json([
                    'Message' => 'Mật khẩu không chính xác, vui lòng nhập lại.',
                    'Status' => '300',
                ]);
            } else {
                $username = $request->input('username');
                $password = $request->input('password');
                if ($this->authentication($username, $password)) {
                    $newPassword = $request->input('newpassword');
                    if ($this->adldap->getProvider('default')->search()->users()->find($username)->changePassword($password, $newPassword)) {
                        return response()->json([
                            'Message' => 'Đổi mật khẩu thành công',
                            'Status' => '200',
                        ]);
                    } else {
                        return response()->json([
                            'Message' => 'Đổi mật khẩu thất bại',
                            'Status' => '300',
                        ]);
                    }
                } else {
                    return response()->json([
                        'Message' => 'Thông tin đăng nhập không chính xác!!',
                        'Status' => '300',
                    ]);
                }
            }
        }else{
            return response()->json([
                'Message' => 'Thiếu thông tin để đổi mật khẩu!',
                'Status' => '300',
            ]);
        }
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('login::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('login::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('login::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
