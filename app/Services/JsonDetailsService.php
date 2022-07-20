<?php

namespace App\Services;

use Illuminate\Http\Request;

class JsonDetailsService
{
  public function expand(Request $request): ?array
  {
      $safeParams = ['ingredients','category','tags'];

      $requestWith = $request->query('with');

      if(!isset($requestWith)){
          return null;
      }

      $paramsList = explode(',',$requestWith);
      $paramsList = array_unique($paramsList);
      foreach ($paramsList as $key => $param){
          if(!in_array($param, $safeParams)){
              //unset($paramsList[$key]);
              abort( response()->json("$param is not valid parameter", 500) );
          }
      }

      return $paramsList;
  }

  public function definePerPage(Request $request): int
  {
      $requestPerPage = $request->query('per_page');
      if(!isset($requestPerPage)){
          return 0;
      }
      if(is_numeric($requestPerPage) && $requestPerPage > 0){
          return $requestPerPage;
      }
      else return 0;
  }
}
