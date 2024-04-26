<?php

namespace App\Http\Requests;

use App\Models\CopyrightRule;
use App\Models\FossilRegion;
use App\Models\FossilSpeciality;
use App\Models\Licence;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionsUpdateRequest extends ImageRequest
{
    public function rules(): array
    {
        return [
            'first' => ['required'],
            'second' => ['required'],
            'third' => ['required'],
        ];
    }
}
