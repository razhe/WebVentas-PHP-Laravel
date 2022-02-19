<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Validator
use Validator, Str, File;
//Modelo categorias
use App\Models\Category;
//Paquete intervention images
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function __construct(){
        $this-> middleware('auth');
        $this-> middleware('admincheck');
        $this-> middleware('user.status');
    }
    public function getCategories(){
        $categories = Category::where('categories.status', '<>', '3') -> orderBy('id', 'Asc')->get();
        $categoriesData = ['categories' => $categories];
        return view('Admin.categories', $categoriesData);
    }
    public function getCategoriesNames(){
        $categories = Category::where('categories.status', '<>', '3') -> orderBy('id', 'Asc')->get();
        $categoriesData = ['categories' => $categories];
        return response($categoriesData);
    }
    public function postAddCategory(Request $request){
        $rules = 
        [
            'name'   => 'required',
            'status' => 'required',
            'banner' => 'required|image',
            'description' => 'required'
        ];
        $messages =
        [
            'name.required'   => 'Se requiere de un nombre para la categoría.',
            'status.required' => 'Se requiere de un estado para la categoría.',
            'banner.required' => 'Se requiere de una imagen para la categoría.',
            'banner.image'    => 'El archivo seleccionado no es una imagen.',
            'description.required' => 'Se requiere de una descripción para la categoría',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','Se ha producido un error al intentar guardar esta categoría')->with( 'typealert', 'danger');
        else:
            $file        = $request->file('banner');
            $path        = 'img/categories/';
            $file_name   = time().'-'.$file->getClientOriginalName();
            $upload_file = $path. $file_name;
            //mover la imagen con el paquete intervention image
            Image::make($file)
                ->resize(1000, null, function ($constraint) {
                    $constraint->aspectRatio();
                }) 
                -> save($upload_file);

            $category = new Category;

            $category->name   = e($request['name']);
            $category->status = e($request['status']);
            $category-> description= e($request['description']);
            $category->banner = $path.$file_name;
            if ($category -> save()):
                return back() -> withErrors($validator)->with('MsgResponse','¡Categoría guardada con Éxito!')->with( 'typealert', 'success');
            endif;
                
            
        endif;
    }
    public function postDeleteCategory($id){
        $category = Category::findOrFail($id);

        $category->status = e(3);

        if ($category -> save()) {
            return back() -> with('MsgResponse','¡Categoría eliminada Exitosamente!')->with( 'typealert', 'success');
        }
        else{
            return back() -> with('MsgResponse','Se ha producido un error al intentar borrar esta categoría')->with( 'typealert', 'danger');
        }
        
    }
    public function postEditCategory(Request $request){
        $rules = 
        [
            'name'   => 'required',
            'status' => 'required',
            'banner' => 'image',
            'description' => 'required',
        ];
        $messages =
        [
            'name.required'   => 'Se requiere de un nombre para la categoría.',
            'status.required' => 'Se requiere de un estado para la categoría.',
            'banner.image'    => 'El archivo seleccionado no es una imagen.',
            'description.required' => 'Se requiere de una descripción para la categoría',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','Se ha producido un error al intentar actualizar esta categoría')->with( 'typealert', 'danger');
        else:
            $category = Category::findOrFail($request['id']);

            $category->name   = e($request['name']);
            $category->status = e($request['status']);
            $category->description= e($request['description']);

            if ($request->hasFile('banner')) {
                $file        = $request->file('banner');
                $path        = 'img/categories/';
                $file_name   = time().'-'.$file->getClientOriginalName();
                $upload_file = $path. $file_name;
                //mover la imagen con el paquete intervention image
                Image::make($file)
                    ->resize(1000, null, function ($constraint) {
                        $constraint->aspectRatio();
                    }) 
                    -> save($upload_file);


                File::delete($category -> banner);
                $category -> banner  = $path.$file_name;
            }
            if ($category -> save()):
                return back() -> withErrors($validator)->with('MsgResponse','¡Categoría guardada con Éxito!')->with( 'typealert', 'success');
            endif;
                
            
        endif;
    }
    public function getFindCategory($id){
        $category = Category::findOrFail($id);
        return response()->json($category);
    }
}
