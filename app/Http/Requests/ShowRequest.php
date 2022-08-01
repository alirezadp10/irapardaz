<?php

namespace App\Http\Requests;

use App\Models\TimeTable;
use Illuminate\Foundation\Http\FormRequest;

class ShowRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'         => 'required',
            'times'        => 'required|array',
            'times.*.day'  => 'required|in:sat,sun,mon,tue,wed,thu,fri',
            'times.*.time' => 'required|date_format:H:i',
            'capacity'     => 'required|numeric|min:5'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $key = $this->invalidTimes();
            if ($key != -1) {
                $validator->errors()->add("times.$key", __('validation.custom.show.times.duplicate'));
            }
        });
    }

    private function invalidTimes()
    {
        foreach ($this->times as $key => $time) {
            if (TimeTable::where('day', $time['day'])->where('time', $time['time'])->exists()) {
                return $key;
            }
        }

        return -1;
    }
}
