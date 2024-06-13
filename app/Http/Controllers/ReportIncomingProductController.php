<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ReportDamagedProduct;
use App\Models\Supplier;
use App\Models\ReportIncomingProduct;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Ramsey\Uuid\Type\Integer;

class ReportIncomingProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = ReportIncomingProduct::with('product', 'supplier')->get();
        return view('report-incoming-products.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('report-incoming-products.create', compact('products', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_code' => 'required',
            'supplier_code' => 'required',
            'received_date' => 'required|date',
            'quantity' => 'required|integer',
            'quality_status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $report = ReportIncomingProduct::create($request->all());

        if ($report->quality_status == 'Good') {
            $product = Product::where('code', $report->product_code)->first();
            $product->stock += $report->quantity;
            $product->save();
        } else {
            $reportDamage = ReportDamagedProduct::create([
                'report_date' => now(),
                'product_code' => $report->product_code,
                'quantity' => $report->quantity,
                'supplier_code' => $report->supplier_code,
                'status_report' => 'Wait for Confirmation',
                'report_incoming_id' => $report->id
            ]);
        }

        return redirect()->route('report-incoming-products.index')->with('success', 'Report created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ReportIncomingProduct $reportIncomingProduct)
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('report-incoming-products.show', compact('reportIncomingProduct', 'products', 'suppliers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReportIncomingProduct $reportIncomingProduct)
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('report-incoming-products.edit', compact('reportIncomingProduct', 'products', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReportIncomingProduct $reportIncomingProduct)
    {
        $request->validate([
            'product_code' => 'required',
            'supplier_code' => 'required',
            'received_date' => 'required|date',
            'quantity' => 'required|integer',
            'quality_status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $reportIncomingProduct->update($request->all());

        return redirect()->route('report-incoming-products.index')->with('success', 'Report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReportIncomingProduct $reportIncomingProduct)
    {
        $reportIncomingProduct->delete();
        return redirect()->route('report-incoming-products.index')->with('success', 'Report deleted successfully.');
    }

    public function print(Int $id)
    {
        $reportIncomingProduct = ReportIncomingProduct::findOrFail($id);
        $products = Product::where('code', $reportIncomingProduct->product_code)->first();
        $suppliers = Supplier::where('code', $reportIncomingProduct->supplier_code)->first();

        // Load view for PDF
        $pdf = PDF::loadView('print.report-incoming-products', [
            'reportIncomingProduct' => $reportIncomingProduct,
            'product' => $products,
            'supplier' => $suppliers,
        ]);

        $pdf->setPaper('A4', 'portrait');

        // Output PDF
        return $pdf->stream('incoming-product-report.pdf');
    }
}
