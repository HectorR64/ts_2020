@extends('layouts.app')


@section('title')
    <title>Producto</title>
@endsection
@section('prods')
    active
@endsection
@section('true')
aria-expanded="true"
@endsection
@section('prod')
    show
@endsection

@push('css')

  <style>
    .submit-form-loader{
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999999;
      background: #171515b8;
      transition: 1s;
      display: none;
    }
    .submit-form-loader .loader{
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%,-50%);
    }
    .form-control:focus {
      color: #333;
      background-color: #fff;
      border-color: #333;
      outline: 0;
      box-shadow: 0 0 0 0 rgba(0,123,255,.25);
    }
    .form-control {
      border: none;
    }
  </style>
@endpush

@section('content')


<div class="content">
    <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                      <i class="material-icons">restaurant_menu</i>
                    </div>
                    <h4 class="card-title">Productos</h4>
                  </div>
                <div class="card-body">
                    <form action="{{route('item.store')}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                          <!-- Modal body -->
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 ml-auto mr-auto">
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Categoria</label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Seleccionar categoria</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{__($category->name)}}</option>
                                        @endforeach
                                        </select>
                                      </div>
                                      <div class="form-group">
                                        <label class="bmd-label-floating">Nombre</label>
                                        <input type="text" class="form-control" name="product_name" id="product_name" required>
                                      </div>
                                      <div class="form-group">
                                        <label class="bmd-label-floating">Descripcion</label>
                                        <textarea class="form-control" name="description" id="description" rows="3" required>

                                        </textarea>
                                      </div>
                                      <div class="form-group">
                                        <label class="bmd-label-floating">Precio publico</label>
                                        <input type="text" class="form-control" name="sale_price" id="sale_price" required>
                                      </div>
                                      <div class="form-group">
                                        <label class="bmd-label-floating">Costo</label>
                                        <input type="text" class="form-control" name="purchase_price" id="purchase_price" required>
                                      </div>
                                </div>
                                <div class="col-md-6 ml-auto mr-auto">
                                    <br>
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Precio publico</label>
                                        <input type="text" class="form-control" name="sale_price" id="sale_price" required>
                                      </div>
                                    <div class="form-group">
                                        <label class="bmd-label-floating">Disponibilidad</label>
                                        <input type="text" class="form-control" name="stock" id="stock" required>
                                      </div>
                                      <div class="form-group">
                                        <label class="bmd-label-floating">Imagen</label>
                                        <input type="file" class="form-control" name="image" id="image" required>
                                        <input type="hidden" name="hidden_id" id="hidden_id">
                                      </div>
                                </div>
                              </div>
                          </div>
                          <br>
                          <!-- Modal footer -->
                          <button type="button" class="btn btn-danger">Cancelar</button>
                          <button type="submit" class="btn btn-primary add-item">Guardar</button>
                        </form>
                </div>
              </div>
            </div>
        </div>

    </div>
</div>


@endsection

