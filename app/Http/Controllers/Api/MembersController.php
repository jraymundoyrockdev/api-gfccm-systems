<?php

namespace ApiGfccm\Http\Controllers\Api;

use Illuminate\Http\Request;
use ApiGfccm\Http\Requests;
use ApiGfccm\Http\Requests\MemberRequest;
use ApiGfccm\Http\Controllers\Controller;
use ApiGfccm\Repositories\Interfaces\MemberRepositoryInterface;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Http\Responses\CollectionResponse;

class MembersController extends Controller
{

    /**
     * @var MemberRepositoryInterface
     */
    protected $member;

    /**
     * @param MemberRepositoryInterface $member
     */
    public function __construct(MemberRepositoryInterface $member)
    {
        $this->member = $member;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return (new CollectionResponse($this->member->getAllMembers()))->asType('Member');
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
     * @param  MemberRequest  $request
     * @return Response
     */
    public function store(MemberRequest $request)
    {
        $input = array_filter($request->request->all());

        return (new ItemResponse($this->member->createNewMember($input)))->asType('Member');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
