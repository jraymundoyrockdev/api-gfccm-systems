<?php

namespace ApiGfccm\Http\Controllers\Api;

use Illuminate\Http\Request;

use ApiGfccm\Http\Requests;
use ApiGfccm\Http\Controllers\Controller;
use ApiGfccm\Repositories\Interfaces\MinistryRepositoryInterface;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Http\Responses\CollectionResponse;

class MinistryController extends Controller
{

    /**
     * @var MinistryRepositoryInterface
     */
    protected $ministry;

    /**
     * @param MinistryRepositoryInterface $ministry
     */
    public function __construct(MinistryRepositoryInterface $ministry)
    {
        $this->ministry = $ministry;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return (new CollectionResponse($this->ministry->getAllMinistry()))->asType('Ministry');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
