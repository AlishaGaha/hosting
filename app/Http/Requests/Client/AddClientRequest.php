<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Client;

class AddClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|max:50|unique:clients,email',
            'contact_number' => 'required|string|min:10|max:20',
            'address' => 'nullable|string|max:255',
            'domain_name' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|required_with:domain_name',
            'domain_renewal' => ['nullable', Rule::in(Client::DOMAIN_RENEWAL), 'required_with:domain_name'],
            'plan_id' => 'nullable|exists:plans,id',
            'hosting_renewal' => ['nullable', Rule::in(Client::HOSTING_RENEWAL), 'required_with:plan_id'],
            'annual_maintenance_cost_type' => ['nullable', Rule::in(Client::ANNUAL_MAINTENACE_COST_TYPE), 'required_with:domain_name,plan_id'],
            'annual_maintenance_cost' => 'nullable|numeric|min:1|required_with:domain_name,plan_id'
        ];
    }
}
