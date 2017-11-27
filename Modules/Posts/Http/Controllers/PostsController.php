<?php

namespace Modules\Posts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use app\helper;

use Modules\Posts\Entities\posts;
use Modules\Posts\Entities\posttype;
use Modules\Posts\Entities\tags;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    private $posts;
    private $postType;
    private $tags;
    private $helper;
    public function __construct()
    {
        $this->posts=new posts();
        $this->postType= new posttype();
        $this->tags= new tags();
        $this->helper= new helper();
    }

    public function index()
    {
        return view('posts::index');
    }
    public function ListJson(Request $request){
        $pageindex = $request->input('page')-1;
        $pageSize = $request->input('pageSize');
        $key=$request->input('KeyCode');
        $result=array();
        $result['Total']=0;
        $result['Data']=[];
        $list = $this->posts->GetListAll($key,$pageindex,$pageSize);
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
    public function popupedit(){
        return view('posts::popupedit');
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $PostType=$this->postType->GetAllPostType();
        $tags=$this->tags->GetAllTags();
        return view('posts::create',compact(['PostType','tags']));
    }
    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $PostType=$this->postType->GetAllPostType();
        $post=$this->posts->GetPostById($id);
        $tagPost=explode(" ",$post['vTags']);
        $tags=$this->tags->GetAllTags();
        $resultTags=array();
        $i=0;
        foreach ($tags as $item){
            if($this->helper->customSearch($item['vNameTags'],$tagPost) != null){
                $resultTags[$i]['vNameTags']=$item['vNameTags'];
                $resultTags[$i]['isSelected']=1;
            }
            else{
                $resultTags[$i]['vNameTags']=$item['vNameTags'];
                $resultTags[$i]['isSelected']=0;
            }
            $i++;
        }
        return view('posts::edit',compact(['post','PostType','resultTags']));
    }

    public function savepost(Request $request)
    {
        $data=$this->posts->firstOrCreate(
            ['vTieuDe' => $request->input('vTieuDe')],
            [
                'iLoaiBaiViet' => $request->input('iLoaiBaiViet'),
                'vHinhAnh' => $request->input('vHinhAnh'),
                'vLienKet' => $this->helper->create_link($request->input('vTieuDe')),
                'vMoTa' => $request->input('vMoTa'),
                'vNoiDungChiTiet' => $request->input('vNoiDungChiTiet'),
                'vTags' => implode(" ",$request->input('vTags')),
                'vKeyword' => $request->input('vKeyword'),
                'iTrangThai' => $request->input('iTrangThai'),
                'iLuotXem' => 0,
                'iLoaiBai' => 1,
                'vNguoiTao' => session('username'),
                'vNguoiCapNhat' => "",
                'iDelete' => 0,
                'vDescription' => "",
                'iBinhLuan' => 0
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
    public function updatepost(Request $request)
    {
        $data=$this->posts->where('iMaBaiViet', '=', $request->input('iMaBaiViet'))->update
        (
            [
                'vTieuDe' => $request->input('vTieuDe'),
                'iLoaiBaiViet' => $request->input('iLoaiBaiViet'),
                'vHinhAnh' => $request->input('vHinhAnh'),
                'vLienKet' => $this->helper->create_link($request->input('vTieuDe')),
                'vMoTa' => $request->input('vMoTa'),
                'vNoiDungChiTiet' => $request->input('vNoiDungChiTiet'),
                'vTags' => implode(" ",$request->input('vTags')),
                'vKeyword' => $request->input('vKeyword'),
                'iTrangThai' => $request->input('iTrangThai'),
                'vNguoiCapNhat' => session('username'),
            ]
        );
        if($data!=null){
            return response()->json([
                'Message' => 'Cập nhật thành công!!',
                'Status' => '200',
            ]);
        }
        else{
            return response()->json([
                'Message' => 'Cập nhật thất bại!!',
                'Status' => '300',
            ]);
        }
    }
    public function deletepost(Request $request){
        $data=$this->posts->where('iMaBaiViet', '=', $request->input('iMaBaiViet'))->update
        (
            [
                'iDelete' => 1,
            ]
        );
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
        return view('posts::show');
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
