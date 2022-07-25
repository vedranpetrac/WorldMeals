<?php

namespace App\Http\Requests;

use App\Models\Locale;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Services\LanguageService;

class MealIndexRequest extends FormRequest
{


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        $langService = new LanguageService();
        $defLang = $langService->getDefaultCode();

        $this->redirect = $this->url() . '?lang=' . $defLang;

        return [
            'lang' => ['required',function ($attribute, $value, $fail) {
                $locales = Locale::all();
                $localeId = null;
                foreach ($locales as $locale){
                    if($locale->code == $value) {
                        $localeId = $locale->id;
                    }
                }
                if(!isset($localeId)){
                    $fail('The '.$attribute.' is invalid.');
                }
            }],
            'diff_time' => 'integer|min:1',
            'per_page' => 'integer|min:1',
            'page' => 'integer|min:1',
            'with' => [function ($attribute, $value, $fail){
                $value = explode(',',$value);
                $safeParams = ['ingredients','category','tags'];
                foreach ($value as $key => $param){
                    if(!in_array($param, $safeParams)){
                        //unset($paramsList[$key]);
                        $fail('The '.$attribute.' is invalid.');
                    }
                }
            }],
            'tags' => function ($attribute, $value, $fail){
                $value = explode(',',$value);
                $value = array_unique($value);
                foreach ($value as $param){
                    if(!is_numeric($param) || $param < 0){
                        $fail('The '.$attribute.' is invalid.');
                    }
                }
            },
            'category' => function ($attribute, $value, $fail){
                switch ($value){
                    case strtolower($value) <> 'null' && strtolower($value) <> '!null' && !is_numeric($value):
                    case (is_numeric($value) && $value < 0) :
                        $fail('The '.$attribute.' is invalid.');
                        break;
                }
            },
        ];
    }

}
