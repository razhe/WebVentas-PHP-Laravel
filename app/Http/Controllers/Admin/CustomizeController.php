<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Modelo categorias
use App\Models\Category;
use Validator;

class CustomizeController extends Controller
{
    public function __construct(){
        $this-> middleware('auth');
        $this-> middleware('admincheck');
        $this-> middleware('user.status');
    }
    public function getBannerCustomize(){
        $categories = Category::where('status','<','2') -> orderby('id','ASC') -> get();
        $data = [
            'categories' => $categories
        ];
        return view('Admin.banner', $data);
    }
    public function postChangeBanner(Request $request){
        $rules = [
            'new_category'     => 'required',
            'current_category' => 'required'
        ];
        $messages = [
            'new_category.required'     => 'Error. Faltan parámentros para completar la accion.',
            'current_category.required' => 'Error. Faltan parámentros para completar la accion.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator -> fails()):
            return back() -> withErrors($validator)->with('MsgResponse','')->with( 'typealert', 'danger');
        else:
            $currentCategoryBanner = Category::findOrFail($request['current_category']);
            $newCategoryBanner = Category::findOrFail($request['new_category']);
            if($newCategoryBanner -> on_display == 'on'):
                return back() -> with('MsgResponse','No se puede activar una categoría que ya está activa.')->with( 'typealert', 'danger');
            else:
                $currentCategoryBanner -> on_display = 'off';
                $newCategoryBanner     -> on_display = 'on';
                if($currentCategoryBanner -> save() && $newCategoryBanner -> save()):
                    return back() -> with('MsgResponse','¡Banner actualizado Exitosamente!')->with( 'typealert', 'success');
                endif;
            endif;
        endif;

        
    }
}
/*==============*/
/*Banner*/
/*==============*/

/*==============*/
/*Banner*/
/*==============*/