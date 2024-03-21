<?php

namespace App\Http\Requests;

use App\Models\Country;
use App\Models\County;
use Illuminate\Validation\Rule;

class NewsRequest extends ImageRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'description' => ['required'],
            'name' => ['required'],
            'endpoint' => ['required'],
            'new_order' => ['required'],
            'html' => ['required'],
        ];
    }
}
