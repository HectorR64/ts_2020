<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.partials.usuarios.index',compact('users'));;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name|max:20|min:3',


        ]);
        if ($validation->passes()){
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $store = $user->save();
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
    public function status($id){
        $user = User::findOrFail($id);
        if($user->status == '0'){
            $user->status = '1';
            $user->save();
            return response()->json([
                'message' => 'Hecho! Dato hablilitado exitosamente',
                'alert_type' => 'success',
            ]);
        }else{
            $user->status = '0';
            $user->save();
            return response()->json([
                'message' => 'Hecho! Dato deshabilitado exitosamente',
                'alert_type' => 'success',
            ]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $data = User::findOrFail($id);
        return response()->json($data);
    }
    public function update(Request $request){
        $validation = Validator::make($request->all(), [
            'update_name' => 'required|max:20|min:3',
        ]);

        $id = $request->hidden_id;
        $data = User::find($id);

        if($validation->passes()){
            $data->name = $request->update_name;
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
    public function destroy($id){
        if($id){
            User::find($id)->delete();
            return response()->json([
                "message" => "Hecho! Usuario eliminado exitosamente:)",
                "alert_type" => "success",
            ]);
        }else{
            return response()->json([
                "message" => "Error de conexion",
                "alert_type" => "error",
            ]);
        }
    }
}
