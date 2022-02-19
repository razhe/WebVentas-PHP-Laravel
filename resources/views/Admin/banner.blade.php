@extends('Admin.masterDashboard')
@section('title','Banner')

@section('content')
    <section class="contenedores-banner">
        <!--Validacion formulario-->
        @if(Session::has('MsgResponse'))
            <div class="container box-msgAuth-error">
                <div class="alert alert-{{ Session::get('typealert') }}" style="display:none;">
                {{Session::get('MsgResponse')}}
                @if($errors -> any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
                <script>
                    $('.alert').slideDown();
                    setTimeout(function() {$('.alert').slideUp();}, 8000);
                </script>
                </div>
            </div>
        @endif
        @foreach ($categories as $cat)
            @if ($cat -> on_display == 'on')
                <div class="contenedor-banner">
                    <div class="opciones-banner">
                        <div class="titulo-banner"><h3>Categoría - {{$cat->name}}</h3></div>
                        <form action="{{url('/admin/banner/change-banner')}}" method="post">
                            @csrf
                            <input type="hidden" value="{{$cat -> id}}" name="current_category">
                            <!--Estado-->
                            <div class="input__container input-group mb-2">
                                <select id="" class="form-select category-select-banner" aria-label="Default select example" name="new_category">
                                    @foreach ($categories as $category)
                                        
                                        @if ($category -> id == $cat -> id)
                                            <option selected disabled value="{{$category -> id}}">{{$category -> name}}</option>
                                        @elseif ($category -> on_display == 'on')
                                            <option value="{{$category -> id}}" disabled>{{$category -> name}}</option>
                                        @else
                                            <option value="{{$category -> id}}">{{$category -> name}}</option>                                          
                                        @endif
                                    @endforeach
                                </select>
                            
                                <button type="submit" class="btn btn-success btn-banner-change" disabled>Guardar</button>
                            </div>
                        </form>
                    </div>
                    <div class="box-banner">
                        <div class="row p-0 m-0">
                            <div class="box-img col-lg-5"><img src="{{asset($cat->banner)}}" alt=""></div>
                            <div class="box-contenido col-lg-7">
                                <p>{{$cat -> description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </section>
@endsection

@section('JS')

@endsection