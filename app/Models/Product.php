<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'stock', 'price'
    ];

    /**
     * Generate a unique product code.
     *
     * @return string
     */
    public static function generateCode()
    {
        $count = self::count();
        $newCode = 'PROD-' . str_pad($count + 1, 8, '0', STR_PAD_LEFT);
        return $newCode;
    }

    public function incomingProducts()
    {
        return $this->hasMany(ReportIncomingProduct::class, 'product_code', 'code');
    }

    public function damageProducts()
    {
        return $this->hasMany(ReportDamagedProduct::class, 'product_code', 'code');
    }
    public function returningProducts()
    {
        return $this->hasMany(ReportReturningProduct::class, 'product_code', 'code');
    }
}
