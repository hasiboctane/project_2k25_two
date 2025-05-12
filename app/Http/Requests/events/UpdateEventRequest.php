<?php

namespace App\Http\Requests\events;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
        return [
            'name' =>['required','string','max:255','unique:events,name,'.$this->event->id],
            'description' =>['required','string'],
            'category_id' =>['required','exists:categories,id'],
            'event_banner' =>['image','mimes:jpeg,png,jpg','max:2048'],
            'location' =>['required','string'],
            'type' => ['required', 'string', 'in:free,paid'],
            'price' => ['required_if:type,paid', 'numeric', 'min:0'],
            'start_time' => ['required', 'date', 'after_or_equal:today'],
            'end_time' => ['required', 'date', 'after:start_date'],
            'max_capacity' => ['required', 'integer', 'min:1'],
        ];
    }
}
