<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Http\Controllers\Controller;
use ApiGfccm\Http\Requests\FundItemRequest;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Repositories\Interfaces\FundItemRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class FundItemsController extends Controller
{
    /**
     * @var FundItemRepositoryInterface
     */
    protected $fundItem;

    /**
     * @param FundItemRepositoryInterface $fundItem
     */
    public function __construct(FundItemRepositoryInterface $fundItem)
    {
        $this->fundItem = $fundItem;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FundItemRequest $request
     * @return ItemResponse
     */
    public function store(FundItemRequest $request)
    {
        return (new ItemResponse($this->fundItem->create($request->request->all())))->asType('FundItem');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return ItemResponse|Response
     */
    public function show($id)
    {
        $fundItem = $this->fundItem->findById($id);
        if (!$fundItem) {
            return (new Response())->setStatusCode(404);
        }
        return (new ItemResponse($fundItem))->asType('FundItem');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FundItemRequest $request
     * @param int $id
     * @return ItemResponse|Response
     */
    public function update(FundItemRequest $request, $id)
    {
        $input = array_filter($request->request->all());

        $fundItem = $this->fundItem->findById($id);
        if (!$fundItem) {
            return (new Response())->setStatusCode(404);
        }

        return (new ItemResponse($this->fundItem->update($input, $id)))->asType('FundItem');
    }

}
