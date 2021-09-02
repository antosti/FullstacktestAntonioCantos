<?php

namespace App\Http\Requests;

use App\Models\Petition;
use Illuminate\Foundation\Http\FormRequest;

class EditPetitionRequest extends FormRequest
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
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'The title of the petition is required',
            'description.required' => 'Description is required for the petition'
        ];
    }

    public function editPetition($petition){
        $edit = Petition::findOrFail($petition);

        $edit->fill([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        $edit->save();
    }
}
