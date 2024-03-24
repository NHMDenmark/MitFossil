<?php
namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserAdminRequest extends ImageRequest
{
    public function rules(): array
    {
        if($this->route()->getName() === 'admin.users.update' || $this->route()->getName() === 'admin.customer.update') {
            $id = $this->route('user');

            if(!$id) {
                $id = $this->route('customer');
            }

            return [
                'username' => ['required', 'string', 'max:32', Rule::unique(User::class)->ignore($id)],
                'password' => ['confirmed'],
                'role' => ['required', 'string'],
            ];
        } else {
            return [
                'username' => 'required|string|max:32|unique:'.User::class,
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'role' => ['required', 'string'],
            ];
        }
    }
}
