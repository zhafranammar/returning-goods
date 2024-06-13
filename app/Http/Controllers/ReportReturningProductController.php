<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ReportReturningProduct;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportReturningProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = ReportReturningProduct::with(['product', 'supplier'])->get();
        return view('report-returning-products.index', compact('reports'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ReportReturningProduct $reportReturningProduct)
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('report-returning-products.show', compact('reportReturningProduct', 'products', 'suppliers'));
    }

    public function updateStatus(Request $request)
    {
        $reportReturningProduct = ReportReturningProduct::find($request->id);
        if ($reportReturningProduct) {
            $reportReturningProduct->status_return = $request->status;
            $date = Carbon::now()->toDateString();
            if ($request->date_field == 'return_date') {
                $reportReturningProduct->return_date = $date;
            } elseif ($request->date_field == 'finished_date') {
                $reportReturningProduct->finished_date = $date;
            }
            $reportReturningProduct->save();

            return response()->json(['success' => true, 'date' => $date]);
        }

        return response()->json(['success' => false]);
    }

    public function print(Int $id)
    {
        $reportReturningProduct = ReportReturningProduct::findOrFail($id);
        $products = Product::where('code', $reportReturningProduct->product_code)->first();
        $suppliers = Supplier::where('code', $reportReturningProduct->supplier_code)->first();

        // Load view for PDF
        $pdf = PDF::loadView('print.report-returning-products', [
            'reportReturningProduct' => $reportReturningProduct,
            'returningProduct' => $products,
            'supplier' => $suppliers,
        ]);

        $pdf->setPaper('A4', 'portrait');

        // Output PDF
        return $pdf->stream('incoming-product-report.pdf');
    }
}
