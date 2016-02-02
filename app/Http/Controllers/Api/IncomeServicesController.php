<?php namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Commands\CreateIncomeServiceCommand;
use ApiGfccm\Http\Requests;
use ApiGfccm\Http\Requests\IncomeServiceRequest;
use ApiGfccm\Http\Responses\CollectionResponse;
use ApiGfccm\Http\Responses\ItemResponse;
use ApiGfccm\Models\IncomeService;
use ApiGfccm\Repositories\Interfaces\IncomeServiceMemberFundRepositoryInterface;
use ApiGfccm\Repositories\Interfaces\IncomeServiceRepositoryInterface;
use Illuminate\Auth\Guard;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IncomeServicesController extends ApiController
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
        IncomeServiceMemberFundRepositoryInterface $memberFund
    )
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
     * @param Response $response
     * @param Gate $gate
     * @return ItemResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function store(IncomeServiceRequest $request, Guard $guard, Response $response, Gate $gate)
    {
        if (!$gate->check('putPostDelete', new IncomeService())) {
            return $response->setContent('Unauthorized')->setStatusCode(302);
        }

        return (new ItemResponse($this->dispatch(
            new CreateIncomeServiceCommand(
                $request->get('service_id'),
                $request->get('service_date'),
                $guard->user()->id,
                3,
                'status')
        )));
    }

    public function updateDenomination(Request $request, Guard $guard, Gate $gate)
    {
        if (!$gate->check('putPostDelete', new IncomeService())) {
            return (new Response())->setContent('Unauthorized')->setStatusCode(302);
        }

        return $this->incomeService->updateDenomination($request->all());
    }
}