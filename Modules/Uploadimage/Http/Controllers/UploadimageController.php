<?php

namespace Modules\Uploadimage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Uploadimage\Entities\thuvienanh;
use Illuminate\Filesystem\Filesystem;

class UploadimageController extends Controller
{
    protected $thuvienanh;
    public function __construct()
    {
        $this->thuvienanh= new thuvienanh();
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('uploadimage::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('uploadimage::create');
    }
    public function uploadpopup(){
        return view('uploadimage::uploadpopup');
    }
    public function deleteImage(Request $request){
        if($request->has('image')){
            $file=$request->input('image');
            $fileUrl=public_path().$file;
            $checkDbExistFile=$this->thuvienanh->where('vUrl','=',$file)->count();
            if($checkDbExistFile!=0){
                if(unlink($fileUrl)){
                    $this->thuvienanh->where('vUrl','=',$file)->delete();
                    return response()->json([
                        'Message' => 'Xóa hình ảnh thành công!!',
                        'Status' => '200',
                    ]);
                }else{
                    return response()->json([
                        'Message' => 'Lỗi. Không thể xóa!!',
                        'Status' => '300',
                    ]);
                }
            }else{
                $this->thuvienanh->where('vUrl','=',$file)->delete();
                return response()->json([
                    'Message' => 'Lỗi. File không tồn tại!!',
                    'Status' => '300',
                ]);
            }
        }
    }
    public function getImageList(Request $request){
        $pageindex = $request->input('page')-1;
        $pageSize = $request->input('pageSize');
        $result=array();
        $result['Total']=0;
        $result['Data']=[];
        $list = $this->thuvienanh->GetListAll($pageindex,$pageSize);
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
    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function StoreImageUpload(Request $request)
    {
        if($request->hasFile('imageposts')) {
            $file = $request->imageposts;
            $filelocation = '/uploads/posts/';
            $file->move(public_path().$filelocation,$file->getClientOriginalName());
            $fileurl=$filelocation.$file->getClientOriginalName();
            $datasizefile=getimagesize(public_path().$fileurl);
            $sizefile=$datasizefile[0]."x".$datasizefile[1];
            $data=$this->thuvienanh->updateOrCreate(
                ['vName' => $file->getClientOriginalName()],
                [
                    'vDungLuong' => $this->bytesToHuman($file->getClientSize()),
                    'vKichThuoc' => $sizefile,
                    'vUrl' => $fileurl
                ]
            );
            if($data != null){
                return response()->json([
                    'Message' => 'Upload hình ảnh thành công!!',
                    'Status' => '200',
                ]);
            }
            else{
                return response()->json([
                    'Message' => 'Upload hình ảnh thất bại!!',
                    'Status' => '300',
                ]);
            }
        }
        else{
            return response()->json([
                'Message' => 'Lỗi. Không nhận được file hình ảnh!!',
                'Status' => '300',
            ]);
        }
    }
    public function bytesToHuman($bytes)
    {
        $units = ['B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('uploadimage::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('uploadimage::edit');
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
