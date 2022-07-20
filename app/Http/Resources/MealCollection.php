<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MealCollection extends ResourceCollection
{

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */


    public function withResponse($request, $response)
    {
        $jsonResponse = json_decode($response->getContent(), true);
        unset($jsonResponse['meta']['links'],$jsonResponse['meta']['from'],$jsonResponse['meta']['path'],$jsonResponse['meta']['to'],$jsonResponse['links']['first'],$jsonResponse['links']['last']);
        $jsonResponse['links']['self'] = $request->fullUrl();
        $response->setContent(json_encode($jsonResponse));
    }
}
