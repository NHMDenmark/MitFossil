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
                'name' => 'required|string|max:255',
                'username' => ['required', 'string', 'max:32', Rule::unique(User::class)->ignore($id)],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($id)],
                'password' => ['confirmed'],
                'role' => ['required', 'string'],
                'zip_code' => ['numeric'],
                'year_birth' => ['numeric'],
            ];
        } else {
            return [
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:32|unique:'.User::class,
                'email' => 'required|string|email|max:255|unique:'.User::class,
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'role' => ['required', 'string'],
                'zip_code' => ['numeric'],
                'year_birth' => ['numeric'],
            ];
        }
    }
}
