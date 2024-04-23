<?php

namespace App\Models;

use CodeIgniter\Model;

class Orders extends Model
{
    const STATUS_ORDER_PLACED = 1;
    const STATUS_ORDER_PROCESSING = 2;
    const STATUS_ORDER_PROCESSED = 3;
    const STATUS_ORDER_OUT_FOR_DELEVERY = 4;
    const STATUS_ORDER_DELEVERED = 4;
    const STATUS_PAYMENT_PENDING = 6;
    const STATUS_CANCELLED = 6;
    protected $table      = 'orders';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['order_no', 'type', 'status', 'itemnary', 'order_date', 'del_status', 'logs', 'created_by', 'updated_by'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
}