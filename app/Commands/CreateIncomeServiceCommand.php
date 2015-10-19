<?php namespace ApiGfccm\Commands;

use ApiGfccm\Commands\Command;

class CreateIncomeServiceCommand extends Command
{
    /**
     * @var int
     */
    public $incomeServiceId;

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
     * @param int $userId
     * @param int $roleAccess
     */
    public function __construct($serviceId, $userId, $roleAccess, $status)
    {
        $this->serviceId = $serviceId;
        $this->userId = $userId;
        $this->roleAccess = $roleAccess;
        $this->status = $status;
    }
}
