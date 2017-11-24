<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Account\Adldap\adldapmodel;

class AccountController extends Controller
{
    protected $adldap;

    /**
     * Constructor.
     *
     * @param AdldapInterface $adldap
     */
    public function __construct()
    {
        $this->adldap = new adldapmodel();
    }

    public function index()
    {
        return view('account::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function createuser()
    {
        $ou=$this->adldap->getorganizationalUnit('ODSCenter');
        for($i = count($ou)-1; $i >= 0; $i--){
            if($ou[$i]["DeptName"] == 'ODSCenter'){
                unset($ou[$i]);
            }
        }
        return view('account::createuser',compact('ou'));
    }
    public function manageuser()
    {
        return view('account::manageuser');
    }
    public function addnewuser(Request $request){
        if($request->has('fullname') && $request->has('password') && $request->has('deptname'))
        {
            $username=ucwords($request->input('fullname'));
            $password=$request->input('password');
            $ou=$request->input('deptname');
            $data=$this->adldap->CreateNewUser($ou,$username,$password);
            if($data == 0){
                return response()->json([
                    'Message' => 'Tạo mới tài khoản "'.$username.'" thành công!!',
                    'Status' => '200',
                ]);
            }else{
                return response()->json([
                    'Message' => 'Tài khoản '.$username.' đã tồn tại. Hệ thống đã tự động thêm số vào để phân biệt.',
                    'Status' => '200',
                ]);
            }
        }else{
            return response()->json([
                'Message' => 'Lỗi. Vui lòng kiểm tra lại thông tin yêu cầu bắt buộc phải nhập !!',
                'Status' => '300',
            ]);
        }
    }
    public function getInfo(Request $request){
        if($request->has('username')) {
            $username = $request->input('username');
            $info=$this->adldap->GetInfoOfUser($username);
            return view('account::popupinfouser',compact('info'));
        }else{
            return response()->json([
                'Message' => 'Lỗi. Không có username truyền vào!!',
                'Status' => '300',
            ]);
        }
    }
    public function ListJson(Request $request){
        $pageindex = $request->input('page')-1;
        $pageSize = $request->input('pageSize');
        $key=$request->input('KeyCode');
        $result=array();
        $result['Total']=0;
        $result['Data']=[];
        $list = $this->GetListAll($key,$pageindex,$pageSize);
        if(count($list)>0){
            $result['Total']=$list[0]['Total'];
            $result['Data']=$list;
        }
        $DataSource = (object) [
            'Data' => $result['Data'],
            'Total' => $result['Total'],
            'Errors' => ''
        ];
        return response()->json($DataSource);
    }
    public function DisableAccount(Request $request){
        if($request->has('username')){
            $username=$request->input('username');
            $data=$this->adldap->DisableAccount($username);
            if($data == true){
                return response()->json([
                    'Message' => 'Khóa tài khoản "'.$username.'" thành công!!',
                    'Status' => '200',
                ]);
            }else{
                return response()->json([
                    'Message' => 'Lỗi. Khóa tài khoản "'.$username.'" thất bại!!',
                    'Status' => '300',
                ]);
            }
        }
        else{
            return response()->json([
                'Message' => 'Lỗi. Không có username truyền vào!!',
                'Status' => '300',
            ]);
        }
    }
    public function EnableAccount(Request $request){
        if($request->has('username')){
            $username=$request->input('username');
            $data=$this->adldap->EnableAccount($username);
            if($data == true){
                return response()->json([
                    'Message' => 'Mở khóa tài khoản "'.$username.'" thành công!!',
                    'Status' => '200',
                ]);
            }else{
                return response()->json([
                    'Message' => 'Lỗi. Mở khóa tài khoản "'.$username.'" thất bại!!',
                    'Status' => '300',
                ]);
            }
        }
        else{
            return response()->json([
                'Message' => 'Lỗi. Không có username truyền vào!!',
                'Status' => '300',
            ]);
        }
    }
    public function ChangeInfo(Request $request){
        if($request->has('username')){
            $username=$request->input('username');
            $group=$request->input('group');
            $result=$this->adldap->AddUserToGroup($username,$group);
            if(count($result)>0) {
                return response()->json([
                    'Message' => 'Thay đổi thông tin thành công !!!',
                    'Status' => '200',
                ]);
            }else{
                return response()->json([
                    'Message' => 'Thay đổi thông tin thành công !!!',
                    'Status' => '200',
                ]);
            }
        }else{
            return response()->json([
                'Message' => 'Thiếu thông tin !!!',
                'Status' => '300',
            ]);
        }
    }

    public function GetListAll($key,$pageindex,$pageSize){

        if($key == ""){
            $data=$this->adldap->getMemberInOU('ODSCenter',$pageindex,$pageSize);
            return $data;
        }
        else{
            $data=$this->adldap->getAllMemberOU('ODSCenter');
            $result=$this->adldap->SearchArray($key,'username',$data);
            if(count($result)>0){
                $result[0]['Total']=count($result);
            }
            return $result;
        }
    }

}
