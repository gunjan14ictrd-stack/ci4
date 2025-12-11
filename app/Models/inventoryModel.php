<?php

namespace App\Models;

use CodeIgniter\Model;

class inventoryModel extends Model
{

     protected $table = 'inventory';
    protected  $primaryKey = 'id';

    protected $allowedFields = ['product_name', 'quantity','price'];

    protected $useTimestamps = true;  // created_at & updated_at
}
