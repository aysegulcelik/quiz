<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class questionCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'question'=>'required|min:3',
            'image'=>'image|nullable|max:1024¨|mimes:jpg,jpeg,png',
            'answer1'=>'required|min:1',
            'answer2'=>'required|min:1',
            'answer3'=>'required|min:1',
            'answer4'=>'required|min:1',
            'correct_answer'=>'required|min:1',
        ];
    }
    public  function attributes()
    {
        return[
            'question'=>'soru',
            'image'=>'soru fotoğrafı',
            'answer1'=>'1.cevap',
            'answer2'=>'2.cevap',
            'answer3'=>'3.cevap',
            'answer4'=>'4.cevap',
            'correct_answer'=>'doğru cevap',
        ];
    }
}
