<?php

namespace App\Http\Requests;

use App\Enumerations\ExtraPointType;
use App\Enumerations\LanguageExamLevel;
use App\Enumerations\SubjectLevel;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CalculatePointsRequest extends FormRequest
{
    private string $subjectTypes;
    private string $languageExamTypes;
    private string $extraPointType;

    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        $this->subjectTypes = implode(',', array_map(fn($case) => $case->value, SubjectLevel::cases()));
        $this->languageExamTypes = implode(',', array_map(fn($case) => $case->value, LanguageExamLevel::cases()));
        $this->extraPointType = implode(',', array_map(fn($case) => $case->value, ExtraPointType::cases()));

        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }

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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'valasztott-szak.egyetem' => ['required', 'string'],
            'valasztott-szak.kar' => ['required', 'string'],
            'valasztott-szak.szak' => ['required', 'string'],

            'erettsegi-eredmenyek' => ['required', 'array', 'min:1'],
            'erettsegi-eredmenyek.*.nev' => ['required', 'string'],
            'erettsegi-eredmenyek.*.tipus' => ['required', 'string', "in:{$this->subjectTypes}"],
            'erettsegi-eredmenyek.*.eredmeny' => ['required', 'regex:/^\d{1,3}%$/'],

            'tobbletpontok' => ['nullable', 'array'],
            'tobbletpontok.*.kategoria' => ['required_with:tobbletpontok', 'string', "in:{$this->extraPointType}"],
            'tobbletpontok.*.tipus' => ['required_with:tobbletpontok', 'string', "in:{$this->languageExamTypes}"],
            'tobbletpontok.*.nyelv' => ['required_with:tobbletpontok', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'valasztott-szak.egyetem.required' => __('validation.valasztott-szak.egyetem.required'),
            'erettsegi-eredmenyek.*.eredmeny.regex' => __('validation.erettsegi-eredmenyek.eredmeny.regex'),
            'tobbletpontok.*.kategoria.in' => __('validation.tobbletpontok.kategoria.in', ['categories' => $this->extraPointType]),
            'tobbletpontok.*.tipus.in' => __('validation.tobbletpontok.tipus.in', ['languages' => $this->languageExamTypes]),
        ];
    }
}
