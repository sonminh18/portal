<?php

namespace Modules\Posts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Posts\Entities\posts;
use Modules\Posts\Entities\posttype;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    private $posts;
    private $postType;
    public function __construct()
    {
        $this->posts=new posts();
        $this->postType= new posttype();
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
        return view('posts::create',compact('PostType'));
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
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('posts::edit');
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
