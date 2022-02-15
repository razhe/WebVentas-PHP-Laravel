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
        $subcategoriesData = [
            'subcategories' => $subcategories
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
            'status'      => 'required',
            'id_category' => 'required',
            'banner'      => 'required',
            'image1'      => 'required',
            'image2'      => 'required',
            'image3'      => 'required',
            'image4'      => 'required',
        ];
        $messages =
        [
            'name.required'        => 'Se requiere de un nombre para la Subcategoría.',
            'status.required'      => 'Se requiere de un estado para la Subcategoría.',
            'id_category.required' => 'Se requiere de una categoría padre para la Subcategoría.',
            'banner.required'      => 'Necesita una imagen principal para la subcategoría.',
            'image1.required'      => 'Se necesita la primera imagen secundaria para esta subcategoría.',
            'image2.required'      => 'Se necesita la segunda imagen secundaria para esta subcategoría.',
            'image3.required'      => 'Se necesita la tercera imagen secundaria para esta subcategoría.',
            'image4.required'      => 'Se necesita la cuarta imagen secundaria para esta subcategoría.',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','Se ha producido un error al intentar guardar una subcategoría')->with( 'typealert', 'danger');
        else:
            //Ruta
            $path        = 'img/brands/';
            //Peticiones
            $fileBanner  = $request->file('banner');
            $fileImg1    = $request->file('image1');
            $fileImg2    = $request->file('image2');
            $fileImg3    = $request->file('image3');
            $fileImg4    = $request->file('image4');

            //Nombres
            $file_banner = time().'-'.$fileBanner->getClientOriginalName();
            $file_img1   = time().'-'.$fileImg1->getClientOriginalName();
            $file_img2   = time().'-'.$fileImg2->getClientOriginalName();
            $file_img3   = time().'-'.$fileImg3->getClientOriginalName();
            $file_img4   = time().'-'.$fileImg4->getClientOriginalName();
            
            $subcategory = new Subcategory;

            $subcategory->name        = e($request['name']);
            $subcategory->status      = e($request['status']);
            $subcategory->banner      = $path.$file_banner;
            $subcategory->image1      = $path.$file_img1;
            $subcategory->image2      = $path.$file_img2;
            $subcategory->image3      = $path.$file_img3;
            $subcategory->image4      = $path.$file_img4;
            $subcategory->id_category = e($request['id_category']);
            if ($subcategory -> save()):
                return back() -> withErrors($validator)->with('MsgResponse','¡Subcategoría guardada con Éxito!')->with( 'typealert', 'success');
                //Moviendose la carpeta
                $fileBanner -> move($path, $file_banner);
                $fileImg1 -> move($path, $file_img1);
                $fileImg2 -> move($path, $file_img2);
                $fileImg3 -> move($path, $file_img3);
                $fileImg4 -> move($path, $file_img4);
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
            //Ruta
            $path        = 'img/brands/';
            
            $subcategory = Subcategory::findOrFail($request['id']);

            $subcategory->name        = e($request['name']);
            $subcategory->status      = e($request['status']);
            $subcategory->id_category = e($request['id_category']);

            if ($request->hasFile('banner')) {
                //Peticion
                $fileBanner  = $request->file('banner');
                //Nombre
                $file_banner = time().'-'.$fileBanner->getClientOriginalName();
                //eliminacion e insercion
                File::delete($subcategory -> banner);
                $subcategory -> banner  = $path.$file_banner;
                //Moviendose la carpeta
                $fileBanner -> move($path, $file_banner);
            }elseif ($request->hasFile('image1')) {
                //peticion
                $fileImg1    = $request->file('image1');
                //nombre
                $file_img1   = time().'-'.$fileImg1->getClientOriginalName();
                //Eliminacion e insercin
                File::delete($subcategory -> image1);
                $subcategory -> image1  = $path.$file_img1;
                //Moviendo a la carpeta
                $fileImg1 -> move($path, $file_img1);
            }elseif ($request->hasFile('image2')) {
                //peticion
                $fileImg2    = $request->file('image2');
                //nombre
                $file_img2   = time().'-'.$fileImg2->getClientOriginalName();
                //Eliminacion e insercin
                File::delete($subcategory -> image2);
                $subcategory -> image2  = $path.$file_img2;
                //Moviendo a la carpeta
                $fileImg2 -> move($path, $file_img2);
            }elseif ($request->hasFile('image3')) {
                //peticion
                $fileImg3    = $request->file('image3');
                //nombre
                $file_img3   = time().'-'.$fileImg3->getClientOriginalName();
                //Eliminacion e insercin
                File::delete($subcategory -> image3);
                $subcategory -> image3  = $path.$file_img3;
                //Moviendo a la carpeta
                $fileImg3 -> move($path, $file_img3);
            }elseif ($request->hasFile('image4')) {
                //peticion
                $fileImg4    = $request->file('image4');
                //nombre
                $file_img4   = time().'-'.$fileImg4->getClientOriginalName();
                //Eliminacion e insercin
                File::delete($subcategory -> image4);
                $subcategory -> image4  = $path.$file_img4;
                //Moviendo a la carpeta
                $fileImg4 -> move($path, $file_img4);
            }

            if ($subcategory -> save()):
                return back() -> withErrors($validator)->with('MsgResponse','¡Subcategoría guardada con Éxito!')->with( 'typealert', 'success');
            endif;
        endif;
    }
}
