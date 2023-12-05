<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Mprima;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Validator;

class MprimasController extends Controller {

    public function index(){
        $mprimas = Mprima::latest()->get();
        return view('admin.partials.mprimas.index',compact('mprimas'));
    }
    public function getAll(){
        $mprimas = Mprima::latest()->get();
        return response()->json($mprimas);
    }
    public function destroy($id){
        if($id){
            Mprima::find($id)->delete();
            return response()->json([
                "message" => "Hecho: Dato eliminado exitosamente",
                "alert_type" => "success",
            ]);
        }else{
            return response()->json([
                "message" => "Error de conexion",
                "alert_type" => "error",
            ]);
        }
    }
    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'nom_mprima' => 'required|unique:categories,name|max:20|min:3',
        ]);
        if ($validation->passes()){
           $data = new Mprima;
           $data->nom_mprima = $request->nom_mprima;
           $store = $data->save();
           if($store){
                return response()->json([
                    'message' => 'Hecho: Dato guardado exitosamente',
                    'alert_type' => 'success',
                ]);
            }else{
                return response()->json([
                    'error' => 'Error de conexion',
                    'alert_type' => 'error',
                ]);
           }
        }else{
            return response()->json([
                'error' => $validation->errors()->all(),
                'alert_type' => 'error',
            ]);
        }
    }
    public function edit($id){
        $data = Mprima::findOrFail($id);
        return response()->json($data);
    }
    public function update(Request $request){
        $validation = Validator::make($request->all(), [
            'update_name' => 'required|max:20|min:3',
            'update_price' => 'required|max:20|min:3',
        ]);

        $id = $request->hidden_id;
        $data = Mprima::find($id);

        if($validation->passes()){
            $data->nom_mprima = $request->update_name;
            $data->cost_comp = $request->update_price;
            $update = $data->save();
            if ($update != false) {
                return response()->json([
                    'message' => 'Hecho: Dato actualizado exitosamente',
                    'alert_type' => 'success',
                    'name' => $request->update_name,
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

    public function getCategory(){
        $data = Mprima::all();
        return response()->json($data);
    }
}
