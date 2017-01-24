<?php namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Commands\CreateIncomeServiceCommand;
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

        $this->middleware('income.service.auth', ['only' => ['index', 'show', 'getTotal', 'getAllServices']]);
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
        $incomeService = $this->incomeService->findById($id);

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
            return $response->setContent('Unauthorized')->setStatusCode(401);
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

    /**
     * Updates Denomination
     *
     * @param Request $request
     * @param Gate $gate
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function updateDenomination(Request $request, Gate $gate)
    {
        if (!$gate->check('putPostDelete', new IncomeService())) {
            return (new Response())->setContent('Unauthorized')->setStatusCode(401);
        }

        return $this->incomeService->updateDenomination($request->all());
    }

    /**
     * Get Total
     *
     * @param int $year
     * @param null $month
     * @return mixed
     */
    public function getTotal($year, $month = null)
    {
        return $this->incomeService->getTotal($year, $month);
    }

    /**
     * Get all Services within the year or month
     *
     * @param int $year
     * @param int $month
     * @return CollectionResponse
     */
    public function getAllServices($year, $month)
    {
        $incomeServices = $this->incomeService->getAllServices($year, $month);

        return (new CollectionResponse($incomeServices))->asType('IncomeServiceList');
    }
}