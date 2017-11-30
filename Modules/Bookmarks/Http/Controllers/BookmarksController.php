<?php

namespace Modules\Bookmarks\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Bookmarks\Entities\bookmarks;
use app\helper;
use Modules\Account\Adldap\adldapmodel;

class BookmarksController extends Controller
{
    private $bookmarks;
    private $helper;
    private $ldap;
    public function __construct()
    {
        $this->bookmarks= new bookmarks();
        $this->helper=new helper();
        $this->ldap=new adldapmodel();
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('bookmarks::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $Group=$this->ldap->getGroupInOU('Users');
        $TeamName=array();
        foreach ($Group as $item){
            if(strpos($item, 'Team')){
                array_push($TeamName,$item);
            }
        }
        return view('bookmarks::create',compact('TeamName'));
    }
    public function ListJson(Request $request){
        $pageindex = $request->input('page')-1;
        $pageSize = $request->input('pageSize');
        $key=$request->input('KeyCode');
        $result=array();
        $result['Total']=0;
        $result['Data']=[];
        $list = $this->bookmarks->GetListAll($key,$pageindex,$pageSize);
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
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('bookmarks::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('bookmarks::edit');
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
