<?php namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Commands\DeleteIncomeServiceMemberFundTotal;
use ApiGfccm\Commands\UpdateIncomeServiceMemberFund;
use ApiGfccm\Http\Controllers\Controller;
use ApiGfccm\Http\Requests;
use ApiGfccm\Models\IncomeServiceMemberFund;
use ApiGfccm\Repositories\Interfaces\IncomeServiceMemberFundRepositoryInterface;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IncomeServiceMemberFundsController extends Controller
{
    /**
     * @var IncomeServiceMemberFundRepositoryInterface
     */
    protected $incomeService;

    /**
     * @param IncomeServiceMemberFundRepositoryInterface $incomeService
     * @internal param $IncomeServiceMemberFundRepositoryInterface $
     */
    public function __construct(IncomeServiceMemberFundRepositoryInterface $incomeService)
    {
        $this->incomeService = $incomeService;
    }

    /**
     * Updates Member Funds and Calculate Amount
     *
     * @param Request $request
     * @param Response $response
     * @param Gate $gate
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateMemberFund(Request $request, Response $response, Gate $gate)
    {
        if (!$gate->check('putPostDelete', new IncomeServiceMemberFund())) {
            return $response->setContent('Unauthorized')->setStatusCode(302);
        }

        $input = $request->all();
        $validate = $this->validateUpdateMemberIncomeService(array_shift($input));

        if (!empty($validate)) {
            return $response->setContent($validate)->setStatusCode(422);
        }

        return response()->json(($this->dispatch(
            new UpdateIncomeServiceMemberFund($request->all())
        )));

    }

    /**
     * Deletes members funds and recalculates total
     *
     * @param $incomeServiceId
     * @param $memberId
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteMemberFund($incomeServiceId, $memberId, Response $response, Gate $gate)
    {
        if (!$gate->check('putPostDelete', new IncomeServiceMemberFund())) {
            return $response->setContent('Unauthorized')->setStatusCode(302);
        }

        return response()->json(($this->dispatch(
            new DeleteIncomeServiceMemberFundTotal($incomeServiceId, $memberId)
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
            return ['message' => 'Validation Error', 'errors' => ['member_id' => ['Member does not exists.']]];
        }

        if (empty($input['income_service_id'])) {
            return [
                'message' => 'Validation Error',
                'errors' => ['income_service_id' => ['Income Service does not exists.']]
            ];
        }

        $member = $this->isMemberExits($input['income_service_id'], $input['member_id']);

        if ($member) {
            return ['message' => 'Validation Error', 'errors' => ['member_id' => ['Member already Exists.']]];
        }

        return [];
    }

    /**
     * Check for member duplication
     *
     * @param $incomeServiceId
     * @param $memberId
     * @return mixed
     */
    private function isMemberExits($incomeServiceId, $memberId)
    {
        return $this->incomeService->getByIdAndMemberId($incomeServiceId, $memberId);
    }
}
