<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'date' => $this->date,
            'attachment' => $this->attachment,
            'amount' => $this->amount,
            'status' => $this->status,
            'employee' => [
                'id' => optional($this->employee)->id,
                'name' => optional($this->employee)->name
            ]
        ];
    }
}
