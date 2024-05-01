<?php

namespace App\Jobs;

use CodeIgniter\Queue\BaseJob;
use CodeIgniter\Queue\Interfaces\JobInterface;

class AssignPartner extends BaseJob implements JobInterface
{
    public function process()
    {
        print_r($this->order_id);
        die;
    }
}
