<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use Intervention\Image\Exception\NotReadableException;
use App\Slider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function index(){
        $sliders = Slider::latest()->get();
        return view('admin.partials.slider.sliders',compact('sliders'));
    }
    public function getAll(){
        $sliders = Slider::latest()->get();
        return response()->json($sliders);
    }
    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'title' => 'required|unique:sliders,title',
            'sub_title' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,bmp,webp',
        ]);

        if ($validation->passes()) {
            $image = $request->file('image');

            if ($image) {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
                $photo = Image::make($image)->resize(1920, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode('png', 80);

                Storage::disk('local')->putFileAs('public/sliders', $image, $imageName);

            } else {
                $imageName = 'default.png';
            }

            $slider = new Slider();
            $slider->title = $request->title;
            $slider->sub_title = $request->sub_title;
            $slider->image = $imageName;
            $slider->save();
            return response()->json([
                "message" => "Heco! Dato guardado correctamente:)",
                "alert_type" => "success",
            ]);

        }else {
            return response()->json([
                'message' => $validation->errors()->all(),
                'class_name' => 'alert alert-danger',
            ]);

        }
    }
    public function status($id){
        $slider = Slider::findOrFail($id);
        if($slider->status == '0'){
            $slider->status = '1';
            $slider->save();
            return response()->json([
                'message' => 'Hecho! Dato hablilitado exitosamente',
                'alert_type' => 'success',
            ]);
        }else{
            $slider->status = '0';
            $slider->save();
            return response()->json([
                'message' => 'Hecho! Dato deshabilitado exitosamente',
                'alert_type' => 'success',
            ]);
        }
    }


    public function destroy($id){
        if($id){
            $slider = Slider::findOrFail($id);
            Storage::disk('local')->delete('public/sliders/' . $slider->image);
            $slider->delete();
            return response()->json([
                "message" => "Hecjo! Dato eliminado correctamente:)",
                "alert_type" => "success",
            ]);
        }else{
            return response()->json([
                "message" => "Error! Halgo a salido mal:)",
                "alert_type" => "error",
            ]);
        }
    }
    public function edit($id){
        $slider = Slider::findOrFail($id);
        return response()->json($slider);
    }
    public function update(Request $request){
        $validation = Validator::make($request->all(), [
            'update_title' => 'required',
            'update_sub_title' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif,bmp,webp',
        ]);

        $id = $request->hidden_id;
        $slider = Slider::find($id);

        if ($validation->passes()) {
            $image = $request->file('update_image');
            if ($image) {
                $currentDate = Carbon::now()->toDateString();
                $imageName = $currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

                // Eliminar la imagen antigua si existe en el disco local
                Storage::disk('local')->delete('public/sliders/' .$slider->image);

                // Guardar la nueva imagen en el disco local
                $image->storeAs('sliders', $imageName, 'local');

            } else {
                $imageName = $slider->image;
            }
            $slider->title = $request->update_title;
            $slider->sub_title = $request->update_sub_title;
            $slider->image = $imageName;
            $slider->save();

            return response()->json([
                "message" => "Success! Slider added successfully:)",
                "alert_type" => "success",
            ]);
        }else {
            return response()->json([
                'message' => $validation->errors()->all(),
                'class_name' => 'error',
            ]);
        }
        //return response()->json($request);
    }

}
