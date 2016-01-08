<?php namespace ApiGfccm\Http\Controllers\Api;

use ApiGfccm\Commands\UpdateIncomeServiceMemberFund;
use ApiGfccm\Commands\DeleteIncomeServiceMemberFundTotal;
use ApiGfccm\Http\Controllers\Controller;
use ApiGfccm\Http\Requests;
use Illuminate\Http\Request;

class IncomeServiceMemberFundsController extends Controller
{
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
            return response($validate, 422);
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
    public function deleteMemberFund($incomeServiceId,$memberId)
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
            return ['message' => 'Validation Error', 'errors' => ['member_id' => 'Member does not exists']];
        }

        if (empty($input['income_service_id'])) {
            return ['message' => 'Validation Error', 'errors' => ['income_service_id' => 'Income Service does not exists']];
        }

        return [];
    }
}
