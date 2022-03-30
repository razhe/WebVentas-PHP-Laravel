<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategory;

use Illuminate\Support\Facades\DB; //Trabajar con la base de datos (para prcedimientos almacenados)
use Validator, File;

class SubCategoryController extends Controller
{
    public function __construct(){
        $this-> middleware('auth');
        $this-> middleware('admincheck');
        $this-> middleware('user.status');
    }
    public function getSubcategoriesSelect($id){
        
        $subcategories = Subcategory::where
            ([
            ['subcategories.status', '<>', '3'],
            ['subcategories.id_category', '=', $id],
            ]) 
            -> orderBy('id', 'Asc')->get();
        $subcategoriesData = ['subcategories' => $subcategories];
        return response($subcategoriesData);
    }
    public function getSubcategories(){
        $subcategories = DB::select('CALL subcategories_join_categories()');
        $metrics = DB::select('CALL select_metrics_subcategories()');
        $subcategoriesData = [
            'subcategories' => $subcategories,
            'metrics' => $metrics,
        ];
        return view('Admin.subcategories', $subcategoriesData);      
    }
    public function getSubcategoriesNames()
    {
        $subcategories = DB::select('CALL subcategories_join_categories()');
        $subcategoriesData = [
            'subcategories' => $subcategories
        ];
        return response($subcategoriesData);   
    }
    public function postDeleteSubcategory($id){
        $subcategory = Subcategory::findOrFail($id);

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
            'slug'        => 'required|unique:subcategories,slug',
            'status'      => 'required',
            'id_category' => 'required',
        ];
        $messages =
        [
            'name.required'        => 'Se requiere de un nombre para la Subcategoría.',
            'status.required'      => 'Se requiere de un estado para la Subcategoría.',
            'id_category.required' => 'Se requiere de una categoría padre para la Subcategoría.',
            'slug.required'        => 'Se requiere del slug para la Subcategoría.',
            'slug.unique'         => 'El slug de la subcategoría debe ser único.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','Se ha producido un error al intentar guardar una subcategoría')->with( 'typealert', 'danger');
        else:            
            $subcategory = new Subcategory;

            $subcategory->name        = e($request['name']);
            $subcategory->status      = e($request['status']);
            $subcategory->id_category = e($request['id_category']);
            $subcategory->slug       = $request['slug'];
            if ($subcategory -> save()):
                return back() -> withErrors($validator)->with('MsgResponse','¡Subcategoría guardada con Éxito!')->with( 'typealert', 'success');
            endif;
        endif;
    }
    public function getFindSubcategory($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        return response()->json($subcategory);
    }

    public function postEditSubcategory(Request $request){
        $rules = 
        [
            'name'        => 'required',
            'slug'        => 'required',
            'status'      => 'required',
            'id_category' => 'required'
        ];
        $messages =
        [
            'name.required'        => 'Se requiere de un nombre para la Subcategoría.',
            'status.required'      => 'Se requiere de un estado para la Subcategoría.',
            'id_category.required' => 'Se requiere de una categoría padre para la Subcategoría.',
            'slug.required'        => 'Se requiere del slug para la Subcategoría.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','Se ha producido un error al intentar guardar una subcategoría')->with( 'typealert', 'danger');
        else:
            $subcategory = Subcategory::findOrFail($request['id']);

            if ($request['name'] != $subcategory->name) {
                $subcategory->name = $request['name'];
            }
            if ($request['status'] != $subcategory->status) {
                $subcategory->status = $request['status'];
            }
            if ($request['id_category'] != $subcategory->id_category) {
                $subcategory->id_category = $request['id_category'];
            }
            if ($request['slug'] != $subcategory->slug) {
                $subcategory->slug = $request['slug'];
            }
            if ($subcategory -> save()):
                return back() -> withErrors($validator)->with('MsgResponse','¡Subcategoría guardada con Éxito!')->with( 'typealert', 'success');
            endif;
        endif;
    }
}
