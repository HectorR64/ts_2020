<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Mail\ContactanosMailable;
use DB;
use Illuminate\Support\Facades\Mail;

class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $sliders = Slider::where('status', 1)->get();
        $products = Product::where('status', 1)->get();
        $categorys = Category::where('status', 1)->get();
        return view('welcome',compact('sliders','categorys','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $nom = $request->nombre;
        $cor = $request->correo;
        $com = $request->mensaje;
        $this->validate($request,[
            'nombre'=>'required|regex:/^(?=.{3,40}$)[a-zñA-ZÑáéíóú](\s?[a-zñA-ZÑáéíóú])*$/',
            'correo'=>'required|regex:/^([A-Za-z0-9._-]+@[a-zA-z0-9.-]+\.[a-zA-Z]{2,4}){1}$/',
            'mensaje'=>'required',
        ]);
            Mail::send('correos.contacto',$request->all(), function($msj) use ($nom,$cor,$com){
                $msj->subject('Contacto');
                $msj->to('yao.rock.64@gmail.com');
            });

        return back()->with('success', 'Thanks for contacting us!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('web.producto', compact('categories', 'product'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
