<?php

namespace Modules\Permission\Http\Controllers;
use Modules\Permission\Http\Controllers\PermissionChecker as permission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Adldap\AdldapInterface;
use App\helper;

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

    public function index($request)
    {

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
