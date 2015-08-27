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
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = array_filter($request->request->all());

        return (new ItemResponse($this->ministry->createNewMinistry($input)))->asType('Ministry');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return new ItemResponse($this->ministry->getById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $input = array_filter($request->request->all());

        return (new ItemResponse($this->ministry->updateMinistry($id, $input)))->asType('Ministry');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
