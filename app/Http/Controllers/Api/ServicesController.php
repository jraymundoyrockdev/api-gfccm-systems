<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Http\Requests\ServiceRequest;
use ApiGfccm\Http\Responses\CollectionResponse;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Http\Response;

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
     * @return CollectionResponse|null
     */
    public function index()
    {
        return (new CollectionResponse($this->service->all()))->asType('Service');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ServiceRequest $request
     * @return ItemResponse
     */
    public function store(ServiceRequest $request)
    {
        return (new ItemResponse($this->service->create($request->all())))->asType('Service');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return ItemResponse|Response
     */
    public function show($id)
    {
        $service = $this->service->findById($id);

        if (!$service) {
            return (new Response())->setStatusCode(404);
        }

        return new ItemResponse($service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ServiceRequest $request
     * @param  int $id
     * @return ItemResponse|Response
     */
    public function update(ServiceRequest $request, $id)
    {
        $input = array_filter($request->request->all());

        $service = $this->service->update($input, $id);

        if (!$service) {
            return (new Response())->setStatusCode(404);
        }

        return (new ItemResponse($service))->asType('Service');
    }

    /**
     * Return service as list
     *
     * @return array
     */
    public function asList()
    {
        return $this->service->getAllAsList('name', 'id');
    }

}
