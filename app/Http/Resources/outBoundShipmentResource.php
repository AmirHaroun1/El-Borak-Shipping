<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class outBoundShipmentResource extends JsonResource
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
            'leaving_date'=>$this->leaving_date,
            'delivery_arrival_date'=>$this->delivery_arrival_date,
            'delivery_destination'=>$this->delivery_destination,
            'items' => itemResource::collection($this->whenLoaded('items'))
        ];
    }
}
