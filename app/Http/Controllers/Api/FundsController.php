<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Http\Controllers\Controller;
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
     * @return CollectionResponse|null
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
        return (new ItemResponse($this->fund->create($request->request->all())));
    }

    /**
     * @param int $id
     * @return ItemResponse|Response
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
     * @param FundRequest $request
     * @param $id
     * @return ItemResponse|Response
     */
    public function update(FundRequest $request, $id)
    {
        $fund = $this->fund->findById($id);

        if (!$fund) {
            return (new Response())->setStatusCode(404);
        }

        return (new ItemResponse($this->fund->update($request->request->all(), $id)));
    }

    /**
     * Display list of items of a Fund
     *
     * @param int $fundId
     * @param FundItemRepositoryInterface $fundItem
     * @return CollectionResponse|Response
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
