<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportIncomingProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'supplier_code',
        'received_date',
        'quantity',
        'quality_status',
        'notes',
    ];

    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_code', 'code');
    }

    // Relationship with Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_code', 'code');
    }

    public function reportDamagedProduct()
    {
        return $this->hasOne(ReportDamagedProduct::class, 'report_incoming_id');
    }
}
