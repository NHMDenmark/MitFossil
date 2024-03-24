<?php

namespace App\Http\Requests;

use App\Models\CopyrightRule;
use App\Models\FossilRegion;
use App\Models\FossilSpeciality;
use App\Models\Licence;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends ImageRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $validations = [
            'name' => ['string', 'max:255'],
            'username' => ['string', 'max:32', Rule::unique(User::class)->ignore($this->user()->id)],
        ];

        if($this->user()->role === 'curator') {
              $validations['copyright_rule_id'] = ['required', Rule::exists(CopyrightRule::class, 'id')];
              $validations['fossil_speciality'] = [];
              $validations['fossil_region'] = [];
        }

        return $validations;
    }
}
