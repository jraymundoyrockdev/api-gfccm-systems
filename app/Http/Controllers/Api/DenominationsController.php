<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Http\Requests\DenominationRequest;
use ApiGfccm\Http\Responses\CollectionResponse;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Repositories\Interfaces\DenominationRepositoryInterface;
use Illuminate\Http\Response;

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
     * @return $this
     */
    public function index()
    {
        return (new CollectionResponse($this->denomination->allOrderByAmount()))->asType('Denomination');
    }

    /**
     * @param DenominationRequest $request
     * @return ItemResponse
     */
    public function store(DenominationRequest $request)
    {
        $input = $request->request->all();

        return (new ItemResponse($this->denomination->create($input)))->asType('Denomination');
    }

    /**
     * @param $id
     * @return ItemResponse
     */
    public function show($id)
    {
        $denomination = $this->denomination->findById($id);

        if (!$denomination) {
            return (new Response())->setStatusCode(404);
        }

        return new ItemResponse($denomination);
    }

    /**
     * @param DenominationRequest $request
     * @param $id
     * @return $this
     */
    public function update(DenominationRequest $request, $id)
    {
        $denomination = $this->denomination->update($request->request->all(), $id);

        if (!$denomination) {
            return (new Response())->setStatusCode(404);
        }

        return (new ItemResponse($denomination))->asType('Denomination');
    }
}
