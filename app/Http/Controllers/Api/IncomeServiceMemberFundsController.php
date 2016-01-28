<?php namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Commands\DeleteIncomeServiceMemberFundTotal;
use ApiGfccm\Commands\UpdateIncomeServiceMemberFund;
use ApiGfccm\Http\Controllers\Controller;
use ApiGfccm\Http\Requests;
use ApiGfccm\Repositories\Interfaces\IncomeServiceMemberFundRepositoryInterface;
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
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateMemberFund(Request $request)
    {
        $input = $request->all();

        $validate = $this->validateUpdateMemberIncomeService(array_shift($input));

        if (!empty($validate)) {
            return (new Response())->setContent($validate)->setStatusCode(422);
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
    public function deleteMemberFund($incomeServiceId, $memberId)
    {
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
            return ['message' => 'Validation Error', 'errors' => ['income_service_id' => ['Income Service does not exists.']]];
        }

        $member = $this->isMemberExits($input['member_id'], $input['income_service_id']);

        if ($member) {
            return ['message' => 'Validation Error', 'errors' => ['member_id' => ['Member already Exists.']]];
        }

        return [];
    }

    /**
     * Check for member duplication
     *
     * @param $memberId
     * @param $incomeServiceId
     * @return mixed
     */
    private function isMemberExits($memberId, $incomeServiceId)
    {
        return $this->incomeService->getByIdAndMemberId($memberId, $incomeServiceId);
    }
}
