<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Admin\Entities\modules;
use Modules\Permission\Entities\ou_has_permission;
use Modules\Account\Adldap\adldapmodel;
use App\helper;

class AdminController extends Controller
{
    private $module;
    private $Ou_has_permission;
    protected $adldap;
    protected $helper;

    public function __construct()
    {
        $this->module=new modules();
        $this->Ou_has_permission=new ou_has_permission();
        $this->adldap = new adldapmodel();
        $this->helper = new helper();
    }
    public function ListJsonModule(Request $request){
        $pageindex = $request->input('page')-1;
        $pageSize = $request->input('pageSize');
        $key=$request->input('KeyCode');
        $result=array();
        $result['Total']=0;
        $result['Data']=[];
        $result2=[];
        $list = $this->module->GetListAll($key,$pageindex,$pageSize);
        if(count($list)>0){
            $result['Total']=$list->total();
            $result['Data']=$list->items();
            $i=0;
            foreach ($result['Data'] as $value){
                $GetOuPermission=$this->Ou_has_permission->GetOuWithModuleID($value['iModID']);
                $result2[$i]=$value;
                $result2[$i]['vOU']=implode(', ',$GetOuPermission);
                $i++;
            }

        }
        $DataSource = (object) [
            'Data' => $result2,
            'Total' => $result['Total'],
            'Errors' => ''
        ];
        return response()->json($DataSource);
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('admin::index');
    }
    public function popupmodule(Request $request)
    {
        $ModuleID=$request->input('ModuleID');
        $data_Module=$this->module->GetModuleByID($ModuleID);
        $OUPerAll=$this->Ou_has_permission->GetOuAll($ModuleID);
        $OUPerFeat=$this->Ou_has_permission->GetOuFeat($ModuleID);
        $OU=$this->adldap->getorganizationalUnit('ODSCenter');
        $arr_ou=array();
        foreach ($OU as $value){
            array_push($arr_ou,$value['DeptName']);
        }
        $Result=array();
        $Result2=array();
        $i=0;
        foreach ($arr_ou as $value){
            $Result[$i]['OU']=$value;
            $Result2[$i]['OU']=$value;
            if($this->helper->customSearch($value,$OUPerAll) != null){
                $Result[$i]['Selected']=1;
            }
            else{
                $Result[$i]['Selected']=0;
            }
            if($this->helper->customSearch($value,$OUPerFeat) != null){
                $Result2[$i]['Selected']=1;
            }
            else{
                $Result2[$i]['Selected']=0;
            }
            $i++;
        }
//        echo json_encode($data_Module);
        return view('admin::popupmodule',compact(['Result','Result2','data_Module']));
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin::create');
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
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('admin::edit');
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
