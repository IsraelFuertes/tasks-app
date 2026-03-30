<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [

            'title' => [
                'required',
                'string',
                'min:3',
                'max:200',
                //'regex:/^[^<>{}]*$/',
            ],

            'description' => [
                'nullable',
                'string',
                'max:2000',
            ],

            'status' => [
                'required',
                'string',
                'in:pending,in_progress,completed',
            ],

            'priority' => [
                'required',
                'string',
                'in:low,medium,high',
            ],

            'due_date' => [
                'nullable',
                'date',
                'date_format:Y-m-d',
                'after_or_equal:today',
            ],

            'assigned_email' => [
                'nullable',
                'email:rfc,dns',
                'max:150',
            ],
        ];
    }

    
    public function messages(): array
{
    return [
        'title.required' => 'El título de la tarea es obligatorio.',
        'title.min' => 'El título debe tener al menos 3 caracteres.',
        'title.max' => 'El título no puede exceder 200 caracteres.',
        'title.regex' => 'No se permiten caracteres HTML.',

        'status.required' => 'El estado es obligatorio.',
        'status.in' => 'El estado seleccionado no es válido.',

        'priority.required' => 'La prioridad es obligatoria.',
        'priority.in' => 'La prioridad seleccionada no es válida.',

        'assigned_email.email' => 'El correo asignado no tiene un formato válido.',
        'assigned_email.max' => 'El correo no puede exceder 150 caracteres.',

        'due_date.date' => 'La fecha no es válida.',
        'due_date.after_or_equal' => 'La fecha límite no puede ser una fecha pasada.',
    ];
}

    /**
     * Sanitización
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'title' => trim($this->title ?? ''),
            'description' => trim(strip_tags($this->description ?? '')),
            'assigned_email' => strtolower(trim($this->assigned_email ?? '')),
        ]);
    }
}