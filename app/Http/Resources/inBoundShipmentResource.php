<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class inBoundShipmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'status' => $this->status,
          'created_at'=>$this->created_at,
          'is_in_bound_shipment'=>true,
          'items' => itemResource::collection($this->whenLoaded('items'))
        ];
    }
}
