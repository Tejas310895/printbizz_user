<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductItemnaryGroup extends Model
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    public const TYPE_SINGLE_SELECT = 1;
    public const TYPE_MULTI_SELECT = 2;
    protected $table      = 'products_itemnary_group';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'type', 'icons', 'status', 'created_by', 'updated_by'];

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
