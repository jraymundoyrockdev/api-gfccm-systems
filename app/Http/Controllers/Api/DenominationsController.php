<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Http\Controllers\Api\Transformers\DenominationTransformer;
use Illuminate\Http\Request;

use ApiGfccm\Http\Requests;
use ApiGfccm\Http\Requests\DenominationRequest;
use ApiGfccm\Repositories\Interfaces\DenominationRepositoryInterface;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Http\Responses\CollectionResponse;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;

class DenominationsController extends ApiController
{

    /**
     * @var DenominationRepositoryInterface
     */
    protected $denomination;

    /**
     * @param DenominationRepositoryInterface $denomination
     */
    public function __construct(DenominationRepositoryInterface $denomination)
    {
        $this->denomination = $denomination;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return (new CollectionResponse($this->denomination->allOrderByAmount()));
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
     * @param  DenominationRequest $request
     * @return Response
     */
    public function store(DenominationRequest $request)
    {
        $input = array_filter($request->request->all());

        return (new ItemResponse($this->denomination->create($input)))->asType('Denomination');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return new ItemResponse($this->denomination->findById($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  DenominationRequest $request
     * @param  int $id
     * @return Response
     */
    public function update(DenominationRequest $request, $id)
    {
        $input = array_filter($request->request->all());

        return (new ItemResponse($this->denomination->update($id, $input)))->asType('Denomination');
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
