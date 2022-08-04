<?php

namespace App\Http\Requests;

use App\Models\TimeTable;
use App\Models\Viewer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

/**
 * @property $timeTable
 * @property $viewer
 */
class ReservationRequest extends FormRequest
{
    public function rules()
    {
        return [];
    }

    public function withValidator($validator)
    {
        DB::beginTransaction();

        $this->timeTable = TimeTable::lockForUpdate()->whereId($this->time_table_id)->firstOrFail();

        $this->viewer = Viewer::whereId($this->viewer_id)->firstOrFail();

        $validator->after(function ($validator) {
            if ($this->checkCapacityIsFull()) {
                $validator->errors()->add(
                    "time_table_id",
                    __('validation.custom.reservation.time_table_id.capacity')
                );
            }
        });
    }

    private function checkCapacityIsFull()
    {
        $reserves = $this->timeTable->reserves()->count();

        $capacity = $this->timeTable->show->capacity;

        return $reserves >= $capacity;
    }
}
