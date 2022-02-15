<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Validator
use Validator;
//Modelo categorias
use App\Models\Category;

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
        ];
        $messages =
        [
            'name.required'   => 'Se requiere de un nombre para la categoría.',
            'status.required' => 'Se requiere de un estado para la categoría.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','Se ha producido un error al intentar guardar una categoría')->with( 'typealert', 'danger');
        else:
            $category = new Category;

            $category->name   = e($request['name']);
            $category->status = e($request['status']);
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
        ];
        $messages =
        [
            'name.required'   => 'Se requiere de un nombre para la categoría.',
            'status.required' => 'Se requiere de un estado para la categoría.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','Se ha producido un error al intentar guardar una categoría')->with( 'typealert', 'danger');
        else:
            $category = Category::findOrFail($request['id']);

            $category->name   = e($request['name']);
            $category->status = e($request['status']);
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
