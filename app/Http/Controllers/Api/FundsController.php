<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Http\Controllers\Controller;
use ApiGfccm\Http\Requests;
use ApiGfccm\Http\Requests\FundRequest;
use ApiGfccm\Http\Responses\CollectionResponse;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Repositories\Interfaces\FundItemRepositoryInterface;
use ApiGfccm\Repositories\Interfaces\FundRepositoryInterface;
use Illuminate\Http\Response;

class FundsController extends Controller
{
    /**
     * @var FundRepositoryInterface
     */
    protected $fund;

    /**
     * @var FundItemRepositoryInterface
     */
    protected $fundItem;

    /**
     * @param FundRepositoryInterface $fund
     * @param FundItemRepositoryInterface $fundItem
     */
    public function __construct(FundRepositoryInterface $fund, FundItemRepositoryInterface $fundItem)
    {
        $this->fund = $fund;
        $this->fundItem = $fundItem;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new CollectionResponse($this->fund->all()))->asType('Fund');
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

        return (new ItemResponse($this->fund->create($input)));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fund = $this->fund->findById($id);

        if (!$fund) {
            return (new Response())->setStatusCode(404);
        }

        return (new ItemResponse($fund));
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
        $fund = $this->fund->findById($id);

        if (!$fund) {
            return (new Response())->setStatusCode(404);
        }

        return (new ItemResponse($this->fund->update($id, $request->request->all())));
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
        $fund = $this->fund->findById($fundId);

        if (!$fund) {
            return (new Response())->setStatusCode(404);
        }

        return (new CollectionResponse($fundItem->findByFundId($fundId)))->asType('FundItem');
    }

}
