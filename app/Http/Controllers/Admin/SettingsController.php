<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Modelo categorias
use App\Models\Category;
use Validator, File, Config, Toastr;

class SettingsController extends Controller
{
    public function __construct(){
        $this-> middleware('auth');
        $this-> middleware('admincheck');
        $this-> middleware('user.status');
        $this -> middleware('purchase.step-process');
    }
    /*==============*/
    /*Banner*/
    /*==============*/
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
                Toastr::error('No se puede activar una categoría que ya está activa', '¡Oops...!');
                return back();
            else:
                $currentCategoryBanner -> on_display = 'off';
                $newCategoryBanner     -> on_display = 'on';
                if($currentCategoryBanner -> save() && $newCategoryBanner -> save()):
                    Toastr::success('Ajustes actualizados correctamente', '¡Todo Listo!');
                    return back();
                endif;
            endif;
        endif;
    }
    /*==============*/
    /*Web Config*/
    /*==============*/
    public function getWebCustomize()
    {
        return view('Admin.web-parameters');
    }
    public function postGlobalConfigSave(Request $request)
    {
        if(!file_exists(config_path().'/configuracion-global.php')):
            fopen(config_path().'/configuracion-global.php', 'w');
        endif;
        $file =  fopen(config_path().'/configuracion-global.php', 'w');
        
        $is_logo = false;
        $logo_actual = Config('configuracion-global.logo');

        fwrite($file,'<?php '.PHP_EOL);
        fwrite($file,'return ['.PHP_EOL);
        foreach ($request -> except(['_token']) as $key => $value):
            if(is_null($value)):
                $value = null;
            endif;
            if($key == 'logo'):
                $is_logo = true;
                $file_image   = $request->file('logo');
                $path        = 'static/images/';
                $file_name   = time().'-'.$file_image->getClientOriginalName();
                $logo_nuevo = $path.$file_name;
                if ($logo_actual != $logo_nuevo):
                    File::delete($logo_actual);
                    fwrite($file,"'".$key."' =>"."'" .$path.$file_name ."',".PHP_EOL);
                    $file_image -> move($path, $file_name);
                else:
                    fwrite($file,"'".$key."' =>"."'" .$logo_actual ."',".PHP_EOL);
                endif;
            else:
                fwrite($file,"'".$key."' =>"."'".$value."',".PHP_EOL);
            endif;
        endforeach;

        if($is_logo == false):
            fwrite($file,"'logo' =>"."'" .$logo_actual ."',".PHP_EOL);
        endif;

        fwrite($file,'];'.PHP_EOL);
        fclose($file);
        Toastr::success('Se han actualizado las configuraciones globales exitosamente', '¡Todo Listo!');
        return back();
    }
}
