<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Http\Requests\MinistryRequest;
use ApiGfccm\Http\Responses\CollectionResponse;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Repositories\Interfaces\MinistryRepositoryInterface;
use Illuminate\Http\Response;

class MinistriesController extends ApiController
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
     * @return CollectionResponse
     */
    public function index()
    {
        return (new CollectionResponse($this->ministry->all()))->asType('Ministry');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MinistryRequest $request
     * @return ItemResponse
     */
    public function store(MinistryRequest $request)
    {
        return (new ItemResponse($this->ministry->create($request->all())))->asType('Ministry');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response|ItemResponse
     */
    public function show($id)
    {
        $ministry = $this->ministry->findById($id);

        if (!$ministry) {
            return (new Response())->setStatusCode(404);
        }

        return new ItemResponse($ministry);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MinistryRequest $request
     * @param int $id
     * @return Response|ItemResponse
     */
    public function update(MinistryRequest $request, $id)
    {
        $input = array_filter($request->request->all());

        $ministry = $this->ministry->update($input, $id);

        if (!$ministry) {
            return (new Response())->setStatusCode(404);
        }

        return (new ItemResponse($ministry))->asType('Ministry');
    }

    /**
     * @return array
     */
    public function asList()
    {
        return $this->ministry->getAllAsList('name', 'id');
    }
}
