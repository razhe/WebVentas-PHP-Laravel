<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Validator, Str, File;
class BrandController extends Controller
{
    public function __construct(){
        $this-> middleware('auth');
        $this-> middleware('admincheck');
    }
    public function getBrands(){
        $brands = Brand::where('brands.status', '<>', '3') -> orderby('id', 'Asc')->get();
        $dataBrands = ['brands' => $brands];
        return view('Admin.brands', $dataBrands); 
    }
    public function postAddBrand(Request $request){
        $rules = [
            'name' => 'required',
            'status' => 'required',
            'image' => 'required|image',//se puede poner gift tambien
        ];
        $messages = [
            'name.required'   => 'Se requiere el nombre de la marca.',
            'status.required' => 'Se requiere asignar un estado a la marca.',
            'image.required'  => 'Se requiere una imagen de la marca',
            'image.image'     => 'Solo se pueden subir imagenes.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);
        if ($validator -> fails()) {
            return back() -> withErrors($validator)->with('MsgResponse','Se ha producido un error al intentar guardar la marca')->with( 'typealert', 'danger');
        }else {
            $file        = $request->file('image');
            $path        = 'img/brands/';
            $file_name   = time().'-'.$file->getClientOriginalName();
            $upload_file = $file -> move($path, $file_name);

            $brand = new Brand;
            $brand -> name   = e($request['name']);
            $brand -> status = e($request['status']);
            $brand -> image  = $path.$file_name;

            if ($brand -> save()) {
                return back() -> withErrors($validator)->with('MsgResponse','¡Marca guardada con Éxito!')->with( 'typealert', 'success');
            }
        }
    }
    public function getFindBrand($id)
    {
        $brand = Brand::find($id)->where('brands.status','<>','3') -> orderby('id', 'asc') ->get();
        $brandData = ['brand' => $brand];
        return response($brandData);
    }
    public function postEditBrand(Request $request)
    {
        $rules = [
            'name' => 'required',
            'status' => 'required',
            //'image' => 'image',//se puede poner gift tambien
        ];
        $messages = [
            'name.required'   => 'Se requiere el nombre de la marca.',
            'status.required' => 'Se requiere asignar un estado a la marca.',
            //'image.image'     => 'Solo se pueden subir imagenes.',
        ];

        $validator = Validator::make($request->all(),$rules, $messages);
        if ($validator -> fails()) {
            return back() -> withErrors($validator)->with('MsgResponse','Se ha producido un error al intentar guardar la marca')->with( 'typealert', 'danger');
        }else {
            $brand = Brand::find($request['id']);

            $brand -> name   = e($request['name']);
            $brand -> status = e($request['status']);
            if ($request->hasFile('image')) {
                $file        = $request->file('image');
                $path        = 'img/brands/';
                $file_name   = time().'-'.$file->getClientOriginalName();
                $upload_file = $file -> move($path, $file_name);

                File::delete($brand -> image);
                $brand -> image  = $path.$file_name;
            }
            
            if ($brand -> save()) {
                return back() -> withErrors($validator)->with('MsgResponse','¡Marca modificada con Éxito!')->with( 'typealert', 'success');
            }
        }
    }
    public function postDeleteBrand($id)
    {
        $brand = Brand::find($id);
        $brand -> status = '3';
        if ($brand -> save()) {
            return back() ->with('MsgResponse','¡Marca eliminada con Éxito!')->with( 'typealert', 'success');
        }
    }
    public function getBrandsNames()
    {
        $brands = Brand::where('brands.status', '<>', '3') -> orderBy('id', 'Asc')->get();
        $brandsData = ['brands' => $brands];
        return response($brandsData);
    }
}
