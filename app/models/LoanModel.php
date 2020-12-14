<?php

namespace App\Models;

use App\Core\Http\Model;

class LoanModel extends Model
{
    protected static $schema = 'loan';
    
    protected static $primary_key = 'id';

    protected static $provider = null;

    protected static $fields = array(
        'id',
        'userid',
        'amount',
        'loannumber',
        'duedate',
        'status',
        'created_at',
        'updated_at'
    );
}