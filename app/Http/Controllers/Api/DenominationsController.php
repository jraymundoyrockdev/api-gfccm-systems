<?php

namespace ApiGfccm\Http\Controllers\Api;

use Illuminate\Http\Request;

use ApiGfccm\Http\Requests;
use ApiGfccm\Http\Controllers\Controller;
use ApiGfccm\Repositories\Interfaces\DenominationRepositoryInterface;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Http\Responses\CollectionResponse;

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
        return (new CollectionResponse($this->denomination->getAllDenomination()))->asType('Denomination');
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
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'amount' => 'required|unique:denominations|integer',
            'description' => 'required',
        ]);


        $input = array_filter($request->request->all());

        return (new ItemResponse($this->denomination->createNewDenomination($input)))->asType('Denomination');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        return new ItemResponse($this->denomination->getById($id));
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
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $input = array_filter($request->request->all());

        return (new ItemResponse($this->denomination->updateDenomination($id, $input)))->asType('Denomination');
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
