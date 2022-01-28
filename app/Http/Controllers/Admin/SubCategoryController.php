<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;

use Illuminate\Support\Facades\DB; //Trabajar con la base de datos (para prcedimientos almacenados)
use Validator;

class SubCategoryController extends Controller
{
    public function __construct(){
        $this-> middleware('auth');
        $this-> middleware('admincheck');
    }
    public function getSubcategories(){
        $subcategories = DB::select('CALL subcategories_join_categories()');
        /*
        $subcat = Subcategory::where('subcategories.status', '<>', '3') -> orderBy('id', 'Asc')->get();
        */
        $subcategoriesData = [
            'subcategories' => $subcategories
        ];
        return view('Admin.subcategories', $subcategoriesData);      
    }
    public function postDeleteSubcategory($id){
        $subcategory = Subcategory::find($id);

        $subcategory->status = e(3);

        if ($subcategory -> save()) {
            return back() -> with('MsgResponse','¡Subcategoría eliminada Exitosamente!')->with( 'typealert', 'success');
        }
        else{
            return back() -> with('MsgResponse','Se ha producido un error al intentar borrar esta subcategoría')->with( 'typealert', 'danger');
        }
    }
    public function postAddSubcategory(Request $request)
    {
        $rules = 
        [
            'name'        => 'required',
            'status'      => 'required',
            'id_category' => 'required'
        ];
        $messages =
        [
            'name.required'        => 'Se requiere de un nombre para la Subcategoría.',
            'status.required'      => 'Se requiere de un estado para la Subcategoría.',
            'id_category.required' => 'Se requiere de una categoría padre para la Subcategoría.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','Se ha producido un error al intentar guardar una subcategoría')->with( 'typealert', 'danger');
        else:
            $subcategory = new Subcategory;

            $subcategory->name        = e($request['name']);
            $subcategory->status      = e($request['status']);
            $subcategory->id_category = e($request['id_category']);
            if ($subcategory -> save()):
                return back() -> withErrors($validator)->with('MsgResponse','¡Subcategoría guardada con Éxito!')->with( 'typealert', 'success');
            endif;
        endif;
    }
    public function getFindSubcategory($id)
    {
        $subcategory = Subcategory::find($id);
        return response()->json($subcategory);
    }

    public function postEditSubcategory(Request $request){
        $rules = 
        [
            'name'        => 'required',
            'status'      => 'required',
            'id_category' => 'required'
        ];
        $messages =
        [
            'name.required'        => 'Se requiere de un nombre para la Subcategoría.',
            'status.required'      => 'Se requiere de un estado para la Subcategoría.',
            'id_category.required' => 'Se requiere de una categoría padre para la Subcategoría.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','Se ha producido un error al intentar guardar una subcategoría')->with( 'typealert', 'danger');
        else:
            $subcategory = Subcategory::find($request['id']);

            $subcategory->name        = e($request['name']);
            $subcategory->status      = e($request['status']);
            $subcategory->id_category = e($request['id_category']);
            if ($subcategory -> save()):
                return back() -> withErrors($validator)->with('MsgResponse','¡Subcategoría guardada con Éxito!')->with( 'typealert', 'warning');
            endif;
        endif;
    }
}
