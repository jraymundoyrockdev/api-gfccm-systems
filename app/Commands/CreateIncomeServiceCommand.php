<?php namespace ApiGfccm\Commands;

class CreateIncomeServiceCommand extends Command
{
    /**
     * @var int
     */
    public $incomeServiceId;

    /**
     * @var datetime
     */
    public $serviceDate;

    /**
     * @var int
     */
    public $userId;

    /**
     * @var int
     */
    public $roleAccess;

    /**
     * @var string
     */
    public $status;

    /**
     * Create a new command instance.
     *
     * @param int $serviceId
     * @param datetime $serviceDate
     * @param int $userId
     * @param int $roleAccess
     * @param string $status
     */
    public function __construct($serviceId, $serviceDate, $userId, $roleAccess, $status)
    {
        $this->serviceId = $serviceId;
        $this->serviceDate = $serviceDate;
        $this->userId = $userId;
        $this->roleAccess = $roleAccess;
        $this->status = $status;

    }
}
