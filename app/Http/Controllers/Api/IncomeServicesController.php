<?php namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Commands\CreateIncomeServiceCommand;
use ApiGfccm\Commands\UpdateIncomeServiceMemberFund;
use ApiGfccm\Http\Controllers\Controller;
use ApiGfccm\Http\Requests;
use ApiGfccm\Http\Requests\IncomeServiceRequest;
use ApiGfccm\Http\Responses\CollectionResponse;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Repositories\Interfaces\IncomeServiceMemberFundRepositoryInterface;
use ApiGfccm\Repositories\Interfaces\IncomeServiceRepositoryInterface;
use Illuminate\Auth\Guard;
use Illuminate\Http\Request;
use ApiGfccm\Http\Requests\IncomeServiceMemberFundRequest;


class IncomeServicesController extends Controller
{
    /**
     * @var IncomeServiceRepositoryInterface
     */
    protected $incomeService;

    /**
     * @var IncomeServiceMemberFundRepositoryInterface
     */
    protected $memberFund;

    /**
     * @param IncomeServiceRepositoryInterface $incomeService
     * @param IncomeServiceMemberFundRepositoryInterface $memberFund
     */
    public function __construct(
        IncomeServiceRepositoryInterface $incomeService,
        IncomeServiceMemberFundRepositoryInterface $memberFund)
    {
        $this->incomeService = $incomeService;
        $this->memberFund = $memberFund;
    }

    /**
     * Display a listing Income Services
     *
     * @return CollectionResponse
     */
    public function index()
    {
        return (new CollectionResponse($this->incomeService->all()))->asType('IncomeService');
    }

    /**
     * Display a certain Income Service
     *
     * @param int $id
     * @return ItemResponse
     */
    public function show($id)
    {
        $incomeService = $this->incomeService->show($id);

        if (empty($incomeService)) {
            return response('Unauthorized.', 401);
        }

        return (new ItemResponse($incomeService))->asType('IncomeService');
    }

    /**
     * Create new Income Service
     *
     * @param IncomeServiceRequest $request
     * @param Guard $guard
     * @return ItemResponse
     */
    public function store(IncomeServiceRequest $request, Guard $guard)
    {
        return (new ItemResponse($this->dispatch(
            new CreateIncomeServiceCommand(
                $request->get('service_id'),
                $request->get('service_date'),
                $guard->user()->id,
                3,
                'status')
        )));
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

    public function updateMemberFund(Request $request)
    {
        $input = $request->all();

        $validate = $this->validateUpdateMemberIncomeService(array_shift($input));

        if (!empty($validate)) {
            return response($validate, 422);
        }

        return response()->json(($this->dispatch(
            new UpdateIncomeServiceMemberFund($request->all())
        )));

    }

    /**
     * Custom Validate member_id and income_service_id
     *
     * @param $input
     * @return array
     */
    private function validateUpdateMemberIncomeService($input)
    {
        if (empty($input['member_id'])) {
            return ['message' => 'Validation Error', 'errors' => ['member_id' => 'Member does not exists']];
        }

        if (empty($input['income_service_id'])) {
            return ['message' => 'Validation Error', 'errors' => ['income_service_id' => 'Income Service does not exists']];
        }

        return [];
    }
}