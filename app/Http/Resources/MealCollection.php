<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MealCollection extends ResourceCollection
{
    private $pagination;
    private $links;

    /*
    public function __construct($resource)
    {
        $this->pagination = [
            'currentPage' => $resource->currentPage(),
            'totalItems' => $resource->total(),
            'itemsPerPage' => $resource->perPage(),
            'totalPages' => $resource->lastPage()
        ];

        $this->links = [
            'prev' => $resource->
            'next' => ,
            'self' => ,
        ];

        $resource = $resource->getCollection();

        parent::__construct($resource);
    }
*/
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection;
    }
}
