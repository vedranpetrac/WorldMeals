<?php

namespace App\Services;

use Illuminate\Http\Request;

class JsonDetailsService
{
  public function expand(Request $request): ?array
  {
      $requestWith = $request->query('with');
      if(!isset($requestWith)){
          return null;
      }
      $paramsList = explode(',',$requestWith);
      return array_unique($paramsList);
  }

  public function definePerPage(Request $request): int
  {
      $requestPerPage = $request->query('per_page');
      if(!isset($requestPerPage)){
          return 0;
      }
      else return $requestPerPage;
  }
}
