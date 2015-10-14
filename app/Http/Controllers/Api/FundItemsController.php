<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Http\Controllers\Controller;
use ApiGfccm\Http\Requests;
use ApiGfccm\Http\Requests\FundItemRequest;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Repositories\Interfaces\FundItemRepositoryInterface;

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
        $input = array_filter($request->request->all());

        return (new ItemResponse($this->fundItem->save($input)));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return ItemResponse
     */
    public function show($id)
    {
        return (new ItemResponse($this->fundItem->show($id)))->asType('FundItem');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FundItemRequest $request
     * @param $id
     * @return ItemResponse
     */
    public function update(FundItemRequest $request, $id)
    {
        $input = array_filter($request->request->all());

        return (new ItemResponse($this->fundItem->save($input, $id)));
    }

}
