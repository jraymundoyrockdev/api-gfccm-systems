<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Http\Requests;
use ApiGfccm\Http\Requests\MinistryRequest;
use ApiGfccm\Http\Responses\CollectionResponse;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Repositories\Interfaces\MinistryRepositoryInterface;
use Illuminate\Http\Request;

class MinistryController extends ApiController
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
     * @param MinistryRequest $request
     * @return $this
     */
    public function store(MinistryRequest $request)
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
     * @param MinistryRequest $request
     * @param $id
     * @return $this
     */
    public function update(MinistryRequest $request, $id)
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

    public function asList()
    {
        return $this->ministry->getAllMinistryAsList('name', 'id');
    }
}
