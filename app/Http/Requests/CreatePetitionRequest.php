<?php

namespace App\Http\Requests;

use App\Models\Petition;
use Illuminate\Foundation\Http\FormRequest;
use function Couchbase\defaultEncoder;

class CreatePetitionRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
            'users_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title of the petition is required',
            'description.required' => 'Description is required for the petition'
        ];
    }

    public function createPetition(){
        Petition::create([
            'title' => $this->title,
            'description' => $this->description,
            'users_id' => $this->users_id,
        ]);
    }
}
