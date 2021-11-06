<?php

namespace Modules\Movie\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Movie\Entities\Movie;

class MovieRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       return Movie::rules();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
