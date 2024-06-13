<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportReturningProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'confirm_date',
        'return_date',
        'finished_date',
        'report_damaged_id',
        'product_code',
        'supplier_code',
        'quantity',
        'notes',
        'status_return',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_code', 'code');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_code', 'code');
    }

    public function reportDamagedProduct()
    {
        return $this->belongsTo(ReportDamagedProduct::class, 'report_damaged_id');
    }
}
