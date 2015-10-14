<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Http\Controllers\Controller;
use ApiGfccm\Http\Requests;
use ApiGfccm\Http\Requests\FundRequest;
use ApiGfccm\Http\Responses\CollectionResponse;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Repositories\Interfaces\FundRepositoryInterface;
use ApiGfccm\Repositories\Interfaces\FundItemRepositoryInterface;

class FundsController extends Controller
{
    /**
     * @var FundRepositoryInterface
     */
    protected $fund;

    /**
     * @param FundRepositoryInterface $fund
     */
    public function __construct(FundRepositoryInterface $fund)
    {
        $this->fund = $fund;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new CollectionResponse($this->fund->all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FundRequest $request
     * @return ItemResponse
     */
    public function store(FundRequest $request)
    {
        $input = array_filter($request->request->all());

        return (new ItemResponse($this->fund->save($input)));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return (new ItemResponse($this->fund->show($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FundRequest $request
     * @param int $id
     * @return ItemResponse
     */
    public function update(FundRequest $request, $id)
    {
        $input = array_filter($request->request->all());

        return (new ItemResponse($this->fund->save($input, $id)));
    }

    /**
     * Display list of items of a Fund
     *
     * @param int $fundId
     * @param FundItemRepositoryInterface $fundItem
     * @return $this
     */
    public function showItems($fundId, FundItemRepositoryInterface $fundItem)
    {
        return (new CollectionResponse($fundItem->all($fundId)))->asType('FundItem');
    }

}
