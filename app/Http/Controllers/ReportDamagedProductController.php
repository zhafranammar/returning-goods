<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ReportDamagedProduct;
use App\Models\ReportReturningProduct;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportDamagedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = ReportDamagedProduct::with(['product', 'supplier'])->get();
        return view('report-damaged-products.index', compact('reports'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ReportDamagedProduct $reportDamagedProduct)
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('report-damaged-products.show', compact('reportDamagedProduct', 'products', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReportDamagedProduct $reportDamagedProduct)
    {
        $request->validate([
            'damage_description' => 'required|string',
            'transaction_code' => 'required|string',
        ]);

        $reportDamagedProduct->update($request->all());

        $reportDamagedProduct->status_report = 'Confirmed';
        $reportDamagedProduct->save();

        ReportReturningProduct::create([
            'confirm_date' => now(),
            'product_code' => $reportDamagedProduct->product_code,
            'quantity' => $reportDamagedProduct->quantity,
            'supplier_code' => $reportDamagedProduct->supplier_code,
            'status_return' => 'Wait for Pickup',
            'report_damaged_id' => $reportDamagedProduct->id
        ]);

        return redirect()->route('report-damaged-products.index')->with('success', 'Report updated successfully.');
    }

    public function print(Int $id)
    {
        $reportDamagedProduct = ReportDamagedProduct::findOrFail($id);
        $products = Product::where('code', $reportDamagedProduct->product_code)->first();
        $suppliers = Supplier::where('code', $reportDamagedProduct->supplier_code)->first();

        // Load view for PDF
        $pdf = PDF::loadView('print.report-damaged-products', [
            'reportDamagedProduct' => $reportDamagedProduct,
            'damagedProduct' => $products,
            'supplier' => $suppliers,
        ]);

        $pdf->setPaper('A4', 'portrait');

        // Output PDF
        return $pdf->stream('damaged-product-report.pdf');
    }
}
