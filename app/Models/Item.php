<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "item";
    protected $fillable = ['name', 'item_type', 'price'];
    
    public function invoiceItem(){
        return $this->hasMany(InvoiceItem::class);
    }
}
