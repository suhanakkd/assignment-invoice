<?php

namespace App\Models;
use App\Models\InvoiceDetailed;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceMaster extends Model
{
    protected $table='invoice_master'; 
    use HasFactory;
    public function detail(){
        return $this->hasMany('App\Models\InvoiceDetailed','master_id');
    }
   
}
