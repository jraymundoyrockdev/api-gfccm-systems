<?php

namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Http\Requests;
use ApiGfccm\Http\Requests\MinistryTransactionRequest;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Repositories\Interfaces\MinistryTransactionRepositoryInterface;
use Illuminate\Http\Request;
use ApiGfccm\Models\MinistryTransaction;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\Response;
use ApiGfccm\Http\Responses\CollectionResponse;

class MinistryTransactionsController extends ApiController
{
    /**
     * @var MinistryTransactionRepositoryInterface
     */
    protected $ministryTransaction;

    /**
     * @var Gate
     */
    protected $gate;

    /**
     * @var Response
     */
    protected $response;

    /**
     * MinistryTransactionsController constructor.
     * @param MinistryTransactionRepositoryInterface $ministryTransaction
     * @param Gate $gate
     */
    public function __construct(MinistryTransactionRepositoryInterface $ministryTransaction, Gate $gate)
    {
        $this->ministryTransaction = $ministryTransaction;
        $this->gate = $gate;

      //  $this->middleware('ministry.transaction.auth', ['only' => ['currentBalance']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MinistryTransactionRequest $request
     * @return ItemResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function store(MinistryTransactionRequest $request)
    {
        if (!$this->gate->check('userCredential', new MinistryTransaction($request->all()))) {
            return (new Response)->setContent('Unauthorized')->setStatusCode(401);
        }

        return (new ItemResponse($this->ministryTransaction->create($request->all())));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$this->gate->check('userCredential', new MinistryTransaction(['ministry_id' => $id]))) {
            return (new Response)->setContent('Unauthorized')->setStatusCode(401);
        }

        return (new CollectionResponse($this->ministryTransaction->getAllByMinistryId($id)))->asType('MinistryTransaction');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param null $id
     * @param null $year
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function cashFlow($id = null, $year = null)
    {
        if (!$this->gate->check('userCredential', new MinistryTransaction(['ministry_id' => $id]))) {
            return (new Response)->setContent('Unauthorized')->setStatusCode(401);
        }

        return $this->ministryTransaction->getCashFlow($id, $year);
    }

    /**
     * Get Current Balance of each ministries
     */
    public function currentBalance()
    {
        return $this->ministryTransaction->getAllMinistryCurrentBalance();
    }
}
