<?php

namespace Modules\Permission\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Adldap\AdldapInterface;

class PermissionController extends Controller
{
    protected $adldap;
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

    }


    public function getorganizationalUnit($OU){
        $dn=$this->adldap->search()->ous()->find($OU)->getDn();
        $data=$this->adldap->search()->setDn($dn)->where('objectClass', '=', 'organizationalUnit')->get();
        $result=array();
        foreach ($data as $item){
            $GroupName=$item['ou'][0];
            array_push($result,$GroupName);
        }
        return $result;
    }
    public function getGroupInOU($OU){
        $dn=$this->adldap->search()->ous()->find($OU)->getDn();
        $data=$this->adldap->search()->setDn($dn)->where('objectClass', '=', 'group')->get();
        $result=array();
        foreach ($data as $item){
            $GroupName=$item['cn'][0];
            array_push($result,$GroupName);
        }
        return $result;
    }
    public function getMemberInOU($OU){
        $dn=$this->adldap->search()->ous()->find($OU)->getDn();
        $data=$this->adldap->search()->setDn($dn)->where('objectClass', '=', 'person')->get();
        $result=array();
        foreach ($data as $item){
            $GroupName=$item['cn'][0];
            array_push($result,$GroupName);
        }
        return $result;
    }
    public function getMemberInGroup($GroupName){
        $data = $this->adldap->search()->groups()->find($GroupName);
        $result=array();
        foreach ($data['member'] as $value){
            $CN=explode(',',$value);
            $MemberName=explode('=',$CN[0]);
            array_push($result,$MemberName[1]);
        }
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('permission::create');
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
        return view('permission::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('permission::edit');
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
