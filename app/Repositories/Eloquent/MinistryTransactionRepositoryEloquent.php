<?php namespace ApiGfccm\Repositories\Eloquent;

use ApiGfccm\Models\MinistryTransaction;
use ApiGfccm\Repositories\Interfaces\MinistryTransactionRepositoryInterface;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class MinistryTransactionRepositoryEloquent implements MinistryTransactionRepositoryInterface
{
    /**
     * @var MinistryTransaction
     */
    protected $ministryTransaction;

    /**
     * @var Guard
     */
    protected $guard;

    protected $ministryMap = [
        4 => 1,
        5 => 2,
        6 => 3,
        7 => 4,
        8 => 5,
        9 => 6,
        10 => 7
    ];


    /**
     * MinistryTransactionRepositoryEloquent constructor.
     * @param MinistryTransaction $ministryTransaction
     * @param Guard $guard
     */
    public function __construct(MinistryTransaction $ministryTransaction, Guard $guard)
    {
        $this->ministryTransaction = $ministryTransaction;
        $this->guard = $guard;
    }

    /**
     * Create
     * @param array $payload
     * @return MinistryTransaction
     */
    public function create($payload = [])
    {
        if (array_key_exists('ministry_id', $payload)) {
            $payload['running_balance'] = $this->computeRunningBalance(
                $payload['ministry_id'],
                $payload['amount'],
                $payload['type']
            );
        }

        return $this->ministryTransaction->create($payload);
    }

    /**
     * @param null|int $id
     * @param null|int $year
     * @return MinistryTransaction
     */
    public function getAllByMinistryId($id = null, $year = null)
    {
        if (is_null($id)) {
            return false;
        }

        if (is_null($year)) {
            $year = date('Y');
        }

        return $this->ministryTransaction
            ->where('ministry_id', $id)
            ->whereYear('transaction_date', '=', $year)
            ->get();
    }

    /**
     * @param null $id
     * @param null $year
     * @param null $monthFrom
     * @param null $monthTo
     * @return array
     */
    public function getCashFlow($id = null, $year = null, $monthFrom = null, $monthTo = null)
    {
        return $this->arrangeCashFlow($this->getAllByMinistryId($id, $year));
    }

    /**
     * Get all ministries current running balance
     * 
     * @return array
     */
    public function getAllMinistryCurrentBalance()
    {
        $authorisedRoles = Config::get('authorized_roles.ministry-accountant');
        $currentUserRoles = $this->grantedRoles();

        $allowedMinistryAccess = array_flatten(array_intersect($authorisedRoles, $currentUserRoles));

        $ministries = $this->mapAllowedMinistries($allowedMinistryAccess);

        $currentBalance = $this->ministryTransaction
            ->select(DB::raw('ministry_id, running_balance'))
            ->join(DB::raw('(SELECT MAX(id) id from ministry_transactions GROUP BY ministry_id) b'), function ($join) {
                $join->on('ministry_transactions.id', '=', 'b.id');
            })
            ->whereIn('ministry_id', $ministries)
            ->get();

        return ['MinistryCurrentBalances' => $this->buildCurrentBalanceData($currentBalance)];
    }

    /**
     * @param array $currentBalance
     * @return array
     */
    private function buildCurrentBalanceData($currentBalance = [])
    {
        $ministryBalances = [];

        foreach ($currentBalance as $key => $current) {
            $ministryBalances[$key]['ministry_id'] = $current->ministry_id;
            $ministryBalances[$key]['ministry_name'] = $current->ministry->name;
            $ministryBalances[$key]['running_balance'] = $current->running_balance;
        }

        return $ministryBalances;
    }

    /**
     * @param array $allowedMinistries
     * @return array
     */
    private function mapAllowedMinistries($allowedMinistries = [])
    {
        return array_map(function ($allowedMinistries) {
            return $this->ministryMap[$allowedMinistries];
        }, $allowedMinistries);
    }

    /**
     * Get all roles of the current user
     * @return array
     */
    private function grantedRoles()
    {
        $userRoles = $this->guard->user()->user_role->toArray();

        return array_map(function ($roles) {
            return $roles['role_id'];
        }, $userRoles);
    }

    /**
     * @param array $ministryTransactions
     * @return array
     */
    private function arrangeCashFlow($ministryTransactions = [])
    {
        $transactions = [];

        foreach ($ministryTransactions as $transaction) {
            $transactions[] = $this->buildCashInCashOutData($transaction);
        }

        return ['MinistryTransactions' => $transactions];
    }

    /**
     * @param null $transaction
     * @return array
     */
    private function buildCashInCashOutData($transaction = null)
    {
        if (is_null($transaction)) {
            return [];
        }

        $cashInOutBank = ['cash_in' => 0, 'cash_out' => 0];

        $cashInOutBank[$transaction['type']] = $transaction['amount'];

        return array_merge(
            $cashInOutBank,
            [
                'transaction_date' => $transaction['transaction_date'],
                'running_balance' => $transaction['running_balance'],
                'description' => $transaction['description'],
                'document_image' => $transaction['document_image'],
            ]
        );
    }

    /**
     * @param null $ministryId
     * @param int $amount
     * @param string $type
     * @return int
     */
    private function computeRunningBalance($ministryId = null, $amount = 0, $type = 'cash_in')
    {
        $runningBalance = $this->getLastRunningBalance($ministryId);

        if ($type == 'cash_in') {
            return $runningBalance + $amount;
        }

        return $runningBalance - $amount;
    }

    /**
     * @param $ministryId
     * @return int
     */
    private function getLastRunningBalance($ministryId)
    {
        $transaction = $this->ministryTransaction
            ->where('ministry_id', $ministryId)
            ->orderBy('id', 'desc')
            ->first();

        if (!$transaction) {
            return 0;
        }

        return $transaction['running_balance'];
    }
}
