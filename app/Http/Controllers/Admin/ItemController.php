<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Models\ Product;
use App\Models\Category;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::latest()->get();

        return view('admin.partials.item.index', compact('categories', 'products'));
    }
    public function create(Request $request)
    {
        $categories = Category::all();


        return view('admin.partials.item.create', compact('categories'));
    }
    public function destroy($id){
        if($id){
            $item = Product::findOrFail($id);
            if (file_exists('upload/items/'.$item->image)) {
                unlink('upload/items/'.$item->image);
            }

            $del = $item->delete();
            if($del){
                return response()->json([
                    "message" => "Hecho : Dato eliminado exitosamente:)",
                    "alert_type" => "success",
                ]);
            }else{
                return response()->json([
                    "message" => "Oppos!! Ocurrio un error",
                    "alert_type" => "error",
                ]);
            }
        }else{
            return response()->json([
                "message" => "Error!  Ocurrio un error:)",
                "alert_type" => "error",
            ]);
        }
    }
    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'category'    => 'required|unique:sliders,title',
            'product_name'        => 'required|min:5',
            'description' => 'required',
            'sale_price'       => 'required|numeric',

        ]);

        if ($validation->passes()) {
            $image = $request->file('image');
            if ($image) {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                if (!file_exists('upload/items')) {
                    mkdir('upload/items', 0777, true);
                }
                $image->move(public_path('upload/items'), $imageName);
            } else {
                $imageName = 'default.png';
            }

            $item = new Product();
            $item->category_id = $request->category;
            $item->product_name        = $request->product_name;
            $item->description = $request->description;
            $item->purchase_price  = $request->purchase_price;
            $item->sale_price       = $request->sale_price;
            $item->stock       = $request->stock;
            $item->image       = $imageName;
            $save = $item->save();
            if ($save) {
                return redirect()->route('item.index');
            } else {
                return response()->json([
                    'message' => 'Something Wrong,Query Problem',
                    'alert_type' => 'error',
                ]);
            }


        } else {
            return response()->json([
                'message' => $validation->errors()->all(),
                'class_name' => 'alert alert-danger',
            ]);
        }
    }

    public function status($id){
        $product = Product::findOrFail($id);
        if($product->status == '0'){
            $product->status = '1';
            $product->save();
            return response()->json([
                'message' => 'Hecho! Dato hablilitado exitosamente',
                'alert_type' => 'success',
            ]);
        }else{
            $product->status = '0';
            $product->save();
            return response()->json([
                'message' => 'Hecho! Dato deshabilitado exitosamente',
                'alert_type' => 'success',
            ]);
        }
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.partials.item.edit', compact('categories', 'product'));
    }

    public function editar($id){
        $data = Product::findOrFail($id);
        return response()->json($data);
    }

    public function updates(Request $request){
        $validation = Validator::make($request->all(), [
            'update_stock' => 'required|max:20|min:1',
        ]);

        $id = $request->hidden_id;
        $data = Product::find($id);

        if($validation->passes()){
            $data->stock = $request->update_stock;
            $update = $data->save();
            if ($update != false) {
                return response()->json([
                    'message' => 'Hecho: Dato actualizado exitosamente',
                    'alert_type' => 'success',
                    'stock' => $request->update_stock,
                ]);
            } else {
                return response()->json([
                    'message' => 'Error de conexion',
                    'alert_type' => 'error',
                ]);
            }
        }else {
            return response()->json([
                'require' => $validation->errors()->all(),
                'alert_type' => 'error',
            ]);
        }
    }


    public function update(Request $request, $id){

        $item = Product::find($id);

        $validation = Validator::make($request->all(), [
            'product_name'        => 'required|min:5',
            'description' => 'required',
            'sale_price'       => 'required|numeric',

        ]);

        if ($validation->passes()) {
            $image = $request->file('image');
            if ($image) {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                if (!file_exists('upload/items')) {
                    mkdir('upload/items', 0777, true);
                }
                if (file_exists('upload/items/'.$item->image)) {
                    unlink('upload/items/'.$item->image);
                }
                $image->move(public_path('upload/items'), $imageName);
            } else {
                $imageName = $item->image;
            }
            $item->category_id = $request->category;
            $item->product_name        = $request->product_name;
            $item->description = $request->description;
            $item->purchase_price  = $request->purchase_price;
            $item->sale_price       = $request->sale_price;
            $item->stock       = $request->stock;
            $item->image       = $imageName;
            $save = $item->save();
            if ($save) {
                return redirect()->route('item.index');
            } else {
                return response()->json([
                    'message' => 'Something Wrong,Query Problem',
                    'alert_type' => 'error',
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Please Fillup all field and follow our rules',
                'alert_type' => 'error',
            ]);
        }
    }
}
