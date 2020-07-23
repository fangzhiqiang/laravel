<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        $action = $this->route()->getActionMethod();

        switch($action){
            case 'register':
                return [
                    'name'=>'required|max:32',
                    'phone'=>'required|regex:/^13\d{9}$/',
                    'password'=>'required|regex:/^[a-zA-Z0-9_]{9,32}$/'
                ];
            case 'login':
                return [
                    'phone'=>'required|regex:/^13\d{9}$/',
                    'password'=>'required|regex:/^[a-zA-Z0-9_]{9,32}$/'
                ];
            default :
                return [];
        }

    }
}
