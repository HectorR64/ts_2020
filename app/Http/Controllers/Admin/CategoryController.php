<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

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
            Category::find($id)->delete();
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
        $validation = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name|max:20|min:3',
        ]);
        if ($validation->passes()){

            $image = $request->file('image');
            if ($image) {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                if (!file_exists('upload/category')) {
                    mkdir('upload/category', 0777, true);
                }
                $image->move(public_path('upload/category'), $imageName);

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
                    'message' => 'Hecho: Dto guardado excitosamente',
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
                if (!file_exists('upload/category')) {
                    mkdir('upload/category', 0777, true);
                }
                if (file_exists('upload/category/' . $category->image)) {
                    unlink('upload/category/' . $category->image);
                }
                $image->move(public_path('upload/category'), $imageName);

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
