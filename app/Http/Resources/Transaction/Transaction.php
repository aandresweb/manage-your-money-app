<?php

namespace App\Http\Resources\Transaction;

use Carbon\Carbon;
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
            'area'          => $this->area,
            'user'          => $this->user->name,
            'date'          => Carbon::parse($this->date)->format('d-m-Y'),
            'type'          => $this->type
        ];
    }
}
