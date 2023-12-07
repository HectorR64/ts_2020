<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller {

    public function index(){
        $categorys = Category::latest()->get();
        return view('admin.partials.category.index',compact('categorys'));
    }
    public function getAll(){
        $categorys = Category::latest()->get();
        return response()->json($categorys);
    }
    public function destroy($id){
        if($id){
            $category = Category::find($id);

            if ($category) {
                // Obtener el nombre de la imagen
                $imageName = $category->image;

                // Eliminar la categoría
                $category->delete();

                // Eliminar la imagen asociada si no es la imagen por defecto
                if ($imageName != 'default.png') {
                    Storage::disk('local')->delete('public/category/' . $category->image);
                }

                return response()->json([
                    "message" => "Hecho! Dato eliminado exitosamente :)",
                    "alert_type" => "success",
                ]);
            } else {
                return response()->json([
                    "message" => "Error! La categoría no existe.",
                    "alert_type" => "error",
                ]);
            }
        } else {
            return response()->json([
                "message" => "Error! Ocurrió un problema!",
                "alert_type" => "error",
            ]);
        }
    }
    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name|max:20|min:3',
        ]);
        if ($validation->passes()){

            $image = $request->file('image');
            if ($image) {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

                // Guardar imagen en el disco local
                Storage::disk('local')->putFileAs('public/category', $image, $imageName);
                $image->storeAs('public/category', $imageName, 'local');

            } else {
                $imageName = 'default.png';
            }

           $data = new Category;
           $data->name = $request->name;
           $data->slug = Str::slug($request->name);
           $data->image = $imageName;
           $store = $data->save();
           if($store){
                return response()->json([
                    'message' => 'Hecho: Dato guardado excitosamente',
                    'alert_type' => 'success',
                ]);
            }else{
                return response()->json([
                    'error' => 'Oppos!: Ocurrio un error!',
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
        $category = Category::findOrFail($id);
        if($category->status == '0'){
            $category->status = '1';
            $category->save();
            return response()->json([
                'message' => 'Hecho! Dato hablilitado exitosamente',
                'alert_type' => 'success',
            ]);
        }else{
            $category->status = '0';
            $category->save();
            return response()->json([
                'message' => 'Hecho! Dato deshabilitado exitosamente',
                'alert_type' => 'success',
            ]);
        }
    }

    public function edit($id){
        $data = Category::findOrFail($id);
        return response()->json($data);
    }
    public function update(Request $request){
        $validation = Validator::make($request->all(), [
            'update_name' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif,bmp,webp',
        ]);

        $id = $request->hidden_id;
        $category = Category::find($id);

        if ($validation->passes()) {
            $image = $request->file('update_image');
            if ($image) {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

                // Eliminar la imagen antigua si existe en el disco local
                Storage::disk('local')->delete('public/category/' . $category->image);

                // Guardar la nueva imagen en el disco local
                $image->storeAs('public/category', $imageName, 'local');
            } else {
                $imageName = $category->image;
            }

            $category->name = $request->update_name;
            $category->slug = Str::slug($request->name);
            $category->image = $imageName;
            $category->save();

            return response()->json([
                "message" => "Hecho! Dato actualizado excitosamente:)",
                "alert_type" => "success",
            ]);
        }else {
            return response()->json([
                'message' => $validation->errors()->all(),
                'class_name' => 'alert alert-danger',
            ]);
        }
        //return response()->json($request);
    }

    public function getCategory(){
        $data = Category::all();
        return response()->json($data);
    }
}
