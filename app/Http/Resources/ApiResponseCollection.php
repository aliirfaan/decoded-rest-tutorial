<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiResponseCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $items = $this->collection->all();
        
        return [
            'data' => (\array_key_exists('result', $items)) ? $items['result'] : null,
            'errors' => (\array_key_exists('errors', $items)) ? $items['errors'] : null,
            'links' => (\array_key_exists('links', $items)) ? $items['links'] : null,
            'message' => (\array_key_exists('message', $items)) ? $items['message'] : null,
        ];
    }
}
