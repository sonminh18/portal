<?php

namespace Modules\Bookmarks\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Bookmarks\Entities\bookmarks;
use Modules\Bookmarks\Entities\bookmarkpermission;
use app\helper;
use Modules\Account\Adldap\adldapmodel;

class BookmarksController extends Controller
{
    private $bookmarks;
    private $bookmarkspermission;
    private $helper;
    private $ldap;
    public function __construct()
    {
        $this->bookmarks= new bookmarks();
        $this->bookmarkspermission= new bookmarkpermission();
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
    public function save(Request $request)
    {

        $data=$this->bookmarks->firstOrCreate(
            ['vBookName' => strtoupper($request->input('bookmarksname'))],
            [
                'vBookLink' => $request->input('bookmarkslink'),
                'vBookColor' => $request->input('color'),
                'vBookIcon' => $request->input('icon'),
                'vOwner' => $request->input('bookmarkTeam'),
                'iShowAll' => $request->input('iShowAll'),
                'vUpdater' => ''
            ]);

            if($request->input('iGroup') != null && $request->input('iShowAll') != 1){
                if($data->wasRecentlyCreated){
                    $insertedId = $data->id;
                    $CheckExistPer=$this->bookmarks->bookmarkpermission()->where('iBookID','=',$insertedId)->count();
                    if($CheckExistPer == 0){
                        foreach ($request->input('iGroup') as $value)
                        {
                            $this->bookmarks->bookmarkpermission()->insert([
                                'iBookID' => $insertedId,
                                'vTeamName' => $value
                            ]);
                        }
                    }
                }
            }

        if($data->wasRecentlyCreated){
            return response()->json([
                'Message' => 'Tạo thành công!!',
                'Status' => '200',
            ]);
        }
        else{
            return response()->json([
                'Message' => 'Bookmark này đã tồn tại!!',
                'Status' => '300',
            ]);
        }

    }
    public function delete(Request $request){
        $deletedBookMark=$this->bookmarks->deleteBookMark($request->input('iBookID'));
        if ( $deletedBookMark == true){
            $deletedBookMarkPermission=$this->bookmarkspermission->deleteBookMarkPermission($request->input('iBookID'));
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
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $bookmark=$this->bookmarks->where('iBookID','=',$id)->first();
        $bookmarkpermission=$this->bookmarkspermission->where('iBookID','=',$id)->get();
        $Group=$this->ldap->getGroupInOU('Users');
        $TeamName=array();
        $BelongToTeam=array();
        $i=0;
        foreach ($Group as $item){
            if(strpos($item, 'Team')){
                if($this->helper->SearchArray($item,'vTeamName',$bookmarkpermission)!=null){
                    $TeamName[$i]['iSelected']=1;
                }
                else{
                    $TeamName[$i]['iSelected']=0;
                }
                $TeamName[$i]['vTeamName']=$item;
            }
            if(strpos($item, 'Team')){
                if($bookmark->vOwner == $item){
                    $BelongToTeam[$i]['iSelected']=1;
                }
                else{
                    $BelongToTeam[$i]['iSelected']=0;
                }
                $BelongToTeam[$i]['vTeamName']=$item;
            }
            $i++;
        }
        return view('bookmarks::edit',compact(['bookmark','TeamName','BelongToTeam']));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $data=$this->bookmarks
            ->where('iBookID', $request->input('id'))
            ->update([
                'vBookName' => strtoupper($request->input('bookmarksname')),
                'vBookLink' => $request->input('bookmarkslink'),
                'vBookColor' => $request->input('color'),
                'vBookIcon' => $request->input('icon'),
                'vOwner' => $request->input('bookmarkTeam'),
                'iShowAll' => $request->input('iShowAll'),
                'vUpdater' => ''
            ]);

        if($request->input('iGroup') != null && $request->input('iShowAll') != 1){
            $Id = $request->input('id');
            $this->bookmarkspermission->deleteBookMarkPermission($Id);
            foreach ($request->input('iGroup') as $value)
            {
                $this->bookmarks->bookmarkpermission()->insert([
                    'iBookID' => $Id,
                    'vTeamName' => $value
                ]);
            }
        }

        if($data){
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

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

}
