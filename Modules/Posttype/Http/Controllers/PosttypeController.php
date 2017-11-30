<?php

namespace Modules\Posttype\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Posttype\Entities\posttype;
use app\helper;

class PosttypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    private $postType;
    private $helper;
    public function __construct()
    {
        $this->postType= new posttype();
        $this->helper=new helper();
    }
    public function ListJson(Request $request){
        $pageindex = $request->input('page')-1;
        $pageSize = $request->input('pageSize');
        $key=$request->input('KeyCode');
        $result=array();
        $result['Total']=0;
        $result['Data']=[];
        $list = $this->postType->GetListAll($key,$pageindex,$pageSize);
        if(count($list)>0){
            $result['Total']=$list->total();
            $result['Data']=$list->items();
        }
        $DataSource = (object) [
            'Data' => $result['Data'],
            'Total' => $result['Total'],
            'Errors' => ''
        ];
        return response()->json($DataSource);
    }
    public function index()
    {
        return view('posttype::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $posttype=$this->postType->where('iDelete','=','0')->get();
        return view('posttype::popupcreate',compact('posttype'));
    }
    public function savePostType(Request $request){
        $data=$this->postType->firstOrCreate(
            ['vTenLoaiBaiViet' => $request->input('vTenLoaiBaiViet')],
            [
                'vTenLoaiBaiViet' => $request->input('vTenLoaiBaiViet'),
                'iCapCha' => $request->input('iCapCha'),
                'vLienKet' => $this->helper->create_link($request->input('vTenLoaiBaiViet')),
                'vNguoiTao' => session('username'),
                'iDelete' => 0,
                'vNguoiCapNhat' => "",
            ]
        );
        if($data!=null){
            return response()->json([
                'Message' => 'Tạo thành công!!',
                'Status' => '200',
            ]);
        }
        else{
            return response()->json([
                'Message' => 'Tạo thất bại!!',
                'Status' => '300',
            ]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $posttype=$this->postType->where('iDelete','=','0')->get();
        $posttypeselected=$this->postType->where('iMaLoaiBaiViet','=',$request->input('iMaLoaiBaiViet'))->first();
        $MenuCapCha=array();
        $i=0;
        foreach ($posttype as $item){
            if($item['iMaLoaiBaiViet'] == $posttypeselected['iCapCha']){
                $MenuCapCha[$i]['Selected']=1;
            }else{
                $MenuCapCha[$i]['Selected']=0;
            }
            $MenuCapCha[$i]['iMaLoaiBaiViet']=$item['iMaLoaiBaiViet'];
            $MenuCapCha[$i]['vTenLoaiBaiViet']=$item['vTenLoaiBaiViet'];
            $i++;
        }
        return view('posttype::popupedit',compact(['posttypeselected','MenuCapCha']));
    }
    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function delete(Request $request)
    {
        $iMaLoaiBaiViet=$request->input('iMaLoaiBaiViet');
        $data=$this->postType->where('iMaLoaiBaiViet','=',$iMaLoaiBaiViet)->delete();
        if($data!=null){
            return response()->json([
                'Message' => 'Xóa thành công!!',
                'Status' => '200',
            ]);
        }
        else{
            return response()->json([
                'Message' => 'Xóa thất bại!!',
                'Status' => '300',
            ]);
        }
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('posttype::show');
    }



    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $iMaLoaiBaiViet=$request->input('iMaLoaiBaiViet');
        $data=$this->postType->where('iMaLoaiBaiViet','=',$iMaLoaiBaiViet)->update(
            [
                'iCapCha' => $request->input('iCapCha'),
                'vTenLoaiBaiViet' => $request->input('vTenLoaiBaiViet')
            ]
        );
        if($data!=null){
            return response()->json([
                'Message' => 'Update thành công!!',
                'Status' => '200',
            ]);
        }
        else{
            return response()->json([
                'Message' => 'Update thất bại!!',
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
