<?php

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Resources\Json\JsonResource;

class Transaction extends JsonResource
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
            'id'            => $this->id,
            'description'   => $this->description,
            'ammount'       => $this->ammount,
            'area'          => $this->area->name,
            'user'          => $this->user->name
        ];
    }
}
