<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['nullable', 'string', 'max:400'],
        ];

        if ($this->hasFile('images')) {
            $rules['images'] = ['required'];
            $rules['images.*'] = ['image', 'mimes:jpeg,png', 'max:2048'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'rating.required' => '評価を入力してください',
            'rating.integer' => '評価は整数で入力してください',
            'rating.between' => '評価は1~5の間で入力してください',
            'comment.string' => 'コメントは文字列で入力してください',
            'comment.max' => 'コメントは400文字以内で入力してください',
            'images.required' => '画像ファイルを選択してください',
            'images.*.image' => '画像ファイルを選択してください',
            'images.*.mimes' => '画像ファイルはjpegまたはpng形式のみアップロード可能です',
            'images.*.max' => '画像ファイルは2MB以内で選択してください',
        ];
    }
}
