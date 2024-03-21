<?php

namespace App\Http\Requests;

use App\Models\Country;
use App\Models\County;
use App\Rules\AtLeastOne;
use Illuminate\Validation\Rule;

class FossilRequest extends ImageRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $edit = $this->id != null && $this->id > 0;

        return [
            'images' => ['required', new AtLeastOne($edit)],
        ];
    }
}
