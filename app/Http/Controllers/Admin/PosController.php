<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sale;
use App\Models\User;
use App\Models\Client;
use App\Models\Product;
use App\Models\Category;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;


class PosController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $products = Product::all();
     /**$clients =  DB::table('users')->where('role_id', 2)->get();**/
     $clients = Client::all();
     $categories = Category::all();
     $sales = Sale::all();
     return view('admin.partials.pos.index',compact('sales', 'clients', 'categories', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    $products = Product::all();
    $clients = Client::all();
     return view('admin.partials.pos.create',compact('products','clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $sale = Sale::create([
            'number_sale' => mt_rand(100000, 999999),
            'total' => $data['total'],
            'discount' => $data['discount'],
            'iva_sale' => $data['iva_sale'],
            'total_amount' => $data['total_amount'],
            'client_id' => $data['client_id'],

        ]);
        $dat = $data['product'];
        $qty = $request->get('quantity');
        //attach sale with there products and quantities
        $attach_data = [];
        for ($i = 0; $i < count($dat); $i++) {
            $attach_data[$dat[$i]] = ['quantity' => $qty[$i]];
        }
        $sale->products()->attach($attach_data);
        //check products stock and substract quntities that is sale
        for ($i = 0; $i < count($dat); $i++) {
            $product = Product::find($dat[$i]);
            if ($product->stock == 0) {

            } else {
                $product->stock = $product->stock - ($qty[$i]);
                $product->save();
            }
        }

        return redirect()->back();
    }
    public function show($sale)
    {
        $sale = Sale::findOrFail($sale);

        return view('admin.partials.pos.show', compact('sale'));
    }

    public function destroy($id)
    {

            $sale = Sale::findOrFail($id);
            foreach ($sale->products as $key => $product) {
                $product->update([
                    'stock' => $product->stock + $product->pivot->quantity
                ]);
            }

            Sale::findOrFail($id)->delete();

            return response()->json([
                "message" => "Success! Category deleted successfully:)",
                "alert_type" => "success",
            ]);

    }
    public function customer_invoice_download($sale)
    {
        $sale = Sale::findOrFail($sale);
        $pdf = PDF::setOptions([
                        'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,
                        'logOutputFile' => storage_path('logs/log.htm'),
                        'tempDir' => storage_path('logs/')
                    ])->loadView('admin.partials.pos.pdf', compact('sale'));
        return $pdf->download('sale-'.$sale->code.'.pdf');
    }


}
