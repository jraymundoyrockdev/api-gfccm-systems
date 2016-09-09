<?php namespace ApiGfccm\Commands;

class CreateIncomeServiceCommand extends Command
{
    /**
     * @var int
     */
    public $serviceId;

    /**
     * @var string
     */
    public $serviceDate;

    /**
     * @var int
     */
    public $userId;

    /**
     * @var string
     */
    public $status;

    /**
     * Create a new command instance.
     *
     * @param int $serviceId
     * @param string $serviceDate
     * @param int $userId
     * @param string $status
     */
    public function __construct($serviceId, $serviceDate, $userId, $status)
    {
        $this->serviceId = $serviceId;
        $this->serviceDate = $serviceDate;
        $this->userId = $userId;
        $this->status = $status;
    }
}
