<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index(){
        $clients = Client::latest()->get();
        return view('admin.partials.clients.index',compact('clients'));
    }
    public function getAll(){
        $clients = Client::latest()->get();
        return response()->json($clients);
    }
    public function destroy($id){
        if($id){
            Client::find($id)->delete();
            return response()->json([
                "message" => "Hecho! Dato eliminado excitosamente:)",
                "alert_type" => "success",
            ]);
        }else{
            return response()->json([
                "message" => "Error! Ocurrio un problema!",
                "alert_type" => "error",
            ]);
        }
    }
    public function store(Request $request){

           $data = new Client;
           $data->client_name = $request->client_name;
           $data->email = $request->email;
           $data->phone = $request->phone;
           $data->cp = $request->cp;
           $data->address = $request->address;
           $store = $data->save();
           if($store){
                return response()->json([
                    'message' => 'Hecho: Dto guardado excitosamente',
                    'alert_type' => 'success',
                ]);
            }else{
                return response()->json([
                    'error' => 'Oppos!: Ocurrio un error!',
                    'alert_type' => 'error',
                ]);
           }
    }

    public function status($id){
        $client = Client::findOrFail($id);
        if($client->status == '0'){
            $client->status = '1';
            $client->save();
            return response()->json([
                'message' => 'Hecho! Dato hablilitado exitosamente',
                'alert_type' => 'success',
            ]);
        }else{
            $client->status = '0';
            $client->save();
            return response()->json([
                'message' => 'Hecho! Dato deshabilitado exitosamente',
                'alert_type' => 'success',
            ]);
        }
    }

    public function edit($id){
        $data = Client::findOrFail($id);
        return response()->json($data);
    }
    public function update(Request $request){


        $id = $request->hidden_id;
        $client = Client::find($id);
            $client->client_name = $request->update_name;
            $client->email = $request->update_email;
            $client->phone = $request->update_phone;
            $client->cp = $request->update_cp;
            $client->address= $request->update_address;
            $client->save();

            return response()->json([
                "message" => "Hecho! Dato actualizado excitosamente:)",
                "alert_type" => "success",
            ]);

    }

    public function getCategory(){
        $data = Client::all();
        return response()->json($data);
    }
}
