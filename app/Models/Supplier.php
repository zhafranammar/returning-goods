<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'code', 'contact_person', 'email', 'address'
    ];

    /**
     * Generate a unique product code.
     *
     * @return string
     */
    public static function generateCode()
    {
        $count = self::count();
        $newCode = 'SUPPLIER-' . str_pad($count + 1, 8, '0', STR_PAD_LEFT);
        return $newCode;
    }

    public function incomingProducts()
    {
        return $this->hasMany(ReportIncomingProduct::class, 'supplier_code', 'code');
    }
    public function damageProducts()
    {
        return $this->hasMany(ReportDamagedProduct::class, 'supplier_code', 'code');
    }
    public function returningProducts()
    {
        return $this->hasMany(ReportReturningProduct::class, 'supplier_code', 'code');
    }
}
