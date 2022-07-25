<?php

namespace App\Services;

use App\Models\Locale;
use Illuminate\Http\Request;

class LanguageService
{
    public function getLanguage(Request $request){

        $requestLang = $request->query('lang');

        $locales = Locale::all();
        $localeId = null;

        foreach ($locales as $locale){
            if($locale->code == $requestLang) {
                $localeId = $locale->id;
            }
        }
        if(!isset($localeId)){
            abort( response()->json("$requestLang is not valid lang param", 500) );
        }
        else {
            return $localeId;
        }
    }

    public function getDefaultCode(){
        $locales = Locale::all();

        if(isset($locales)){
            return $locales[0]->code;
        }
        else null;


    }
}
