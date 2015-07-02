<?php

namespace ApiGfccm\Http\Controllers\Api;

use Illuminate\Http\Request;

use ApiGfccm\Http\Requests;
use ApiGfccm\Http\Controllers\Controller;
use ApiGfccm\Repositories\Interfaces\ServiceRepositoryInterface;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Http\Responses\CollectionResponse;

class ServicesController extends ApiController
{

    /**
     * @var ServiceRepositoryInterface
     */
    protected $service;

    /**
     * @param ServiceRepositoryInterface $service
     */
    public function __construct(ServiceRepositoryInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return (new CollectionResponse($this->service->getAllServices()))->asType('Service');
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

        return (new ItemResponse($this->service->createNewService($input)))->asType('Service');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return new ItemResponse($this->service->getById($id));
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

        return (new ItemResponse($this->service->updateService($id, $input)))->asType('Service');
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
