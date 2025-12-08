<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'id';

    protected $allowedFields = ['title', 'description','user_id'];

    protected $useTimestamps = true;  // created_at & updated_at
}