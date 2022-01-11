<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = "invoice";
    protected $fillable = ['destination_id', 'inv_no', 'issue_date', 'due_date', 'subject'];
    
    public function destination(){
        return $this->belongsTo(Destination::class);
    }
    public function invoiceItem(){
        return $this->hasMany(InvoiceItem::class);
    }
}
