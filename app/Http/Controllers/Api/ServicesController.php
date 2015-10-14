<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Http\Requests;
use ApiGfccm\Http\Requests\ServiceRequest;
use ApiGfccm\Http\Responses\CollectionResponse;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Repositories\Interfaces\ServiceRepositoryInterface;

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
     * @param  ServiceRequest $request
     * @return Response
     */
    public function store(ServiceRequest $request)
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
     * @param  ServiceRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(ServiceRequest $request, $id)
    {
        $input = array_filter($request->request->all());

        return (new ItemResponse($this->service->updateService($id, $input)))->asType('Service');
    }

    /**
     * Return service as list
     *
     * @return mixed
     */
    public function asList()
    {
        return $this->service->getAllServicesAsList('name', 'id');
    }

}
