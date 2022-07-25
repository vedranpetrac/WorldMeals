<?php

namespace App\Filters;

use Illuminate\Http\Request;

class MealsFilter
{


    public function getSelectedTagsList(Request $request){
        $requestTags = $request->query('tags');

        if(!isset($requestTags)){
            return null;
        }

        $tagsList = explode(',',$requestTags);
        $tagsList = array_unique($tagsList);

        foreach ($tagsList as $param){
            if(!is_numeric($param) || $param < 0){
                abort( response()->json("$param is not valid parameter for filtering by tags", 500) );
            }
        }
        return $tagsList;
    }

    public function getSelectedCategory(Request $request){
        $requestCat = $request->query('category');
        if(!isset($requestCat)){
            return null;
        }

        switch ($requestCat){
            case strtolower($requestCat) == 'null':
                return [['category_id','=',null]];
            case strtolower($requestCat) == '!null':
                return [['category_id','!=',null]];
            case (is_numeric($requestCat) && $requestCat >= 0) :
                return [['category_id','=',$requestCat]];
        }
    }

    public function getTimestamp(Request $request){
        $requestTimestamp = $request->query('diff_time');
        if(!isset($requestTimestamp)){
            return null;
        }
        if(is_numeric($requestTimestamp) && $requestTimestamp > 0) return $requestTimestamp;
        else abort( response()->json("$requestTimestamp is not valid parameter for filtering by date", 500) );
    }



}
