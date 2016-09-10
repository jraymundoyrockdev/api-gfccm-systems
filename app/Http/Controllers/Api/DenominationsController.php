<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Http\Requests\DenominationRequest;
use ApiGfccm\Http\Responses\CollectionResponse;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Repositories\Interfaces\DenominationRepositoryInterface;
use Illuminate\Http\Response;
use League\Fractal\Resource\Item;

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
     * @return CollectionResponse|null
     */
    public function index()
    {
        return (new CollectionResponse($this->denomination->all()))->asType('Denomination');
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
     * @param int $id
     * @return ItemResponse|Response
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
     * @param int $id
     * @return ItemResponse|Response
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
