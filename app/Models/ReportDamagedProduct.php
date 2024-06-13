<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportDamagedProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_date',
        'product_code',
        'quantity',
        'damage_description',
        'supplier_code',
        'transaction_code',
        'report_incoming_id',
        'status_report',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_code', 'code');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_code', 'code');
    }
    public function reportIncomingProduct()
    {
        return $this->belongsTo(ReportIncomingProduct::class, 'report_incoming_id');
    }

    public function reportReturningProduct()
    {
        return $this->hasOne(ReportReturningProduct::class, 'report_damaged_id');
    }
}
