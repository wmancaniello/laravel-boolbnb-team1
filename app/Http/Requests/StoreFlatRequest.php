<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFlatRequest extends FormRequest
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
            'title' => 'required|min:5',
            'max_guests' => 'required|numeric|integer|min:1',
            'rooms' => 'required|numeric|integer|min:1',
            'beds' => 'required|numeric|integer|min:1',
            'bathrooms' => 'required|numeric|integer|min:1',
            'meters_square' => 'required|numeric|integer|min:1',
            'address' => 'required|min:5',
            'latitude' => 'required|numeric|min:1',
            'longitude' => 'required|numeric|min:1',
            'main_img' => 'required|image',
            'visible' => 'required|in:1,0',
            'description' => 'required|min:20',
            'services' => 'nullable|exists:services,id',
            'photos' => 'nullable|array',
            'photos.*' => 'image'


        ];
    }


    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio.',
            'title.min' => 'Il titolo deve avere almeno 5 caratteri.',
            'title.unique' => 'Esiste già un appartamento con lo stesso titolo.',
    
            'max_guests.required' => 'Il numero massimo di ospiti è obbligatorio.',
            'max_guests.numeric' => 'Il numero massimo di ospiti deve essere un numero.',
            'max_guests.integer' => 'Il numero massimo di ospiti deve essere un numero intero.',
            'max_guests.min' => 'Il numero massimo di ospiti deve essere almeno 1.',
    
            'rooms.required' => 'Il numero di stanze è obbligatorio.',
            'rooms.numeric' => 'Il numero di stanze deve essere un numero.',
            'rooms.integer' => 'Il numero di stanze deve essere un numero intero.',
            'rooms.min' => 'Il numero di stanze deve essere almeno 1.',
    
            'beds.required' => 'Il numero di letti è obbligatorio.',
            'beds.numeric' => 'Il numero di letti deve essere un numero.',
            'beds.integer' => 'Il numero di letti deve essere un numero intero.',
            'beds.min' => 'Il numero di letti deve essere almeno 1.',
    
            'bathrooms.required' => 'Il numero di bagni è obbligatorio.',
            'bathrooms.numeric' => 'Il numero di bagni deve essere un numero.',
            'bathrooms.integer' => 'Il numero di bagni deve essere un numero intero.',
            'bathrooms.min' => 'Il numero di bagni deve essere almeno 1.',
    
            'meters_square.required' => 'Il numero di metri quadrati è obbligatorio.',
            'meters_square.numeric' => 'Il numero di metri quadrati deve essere un numero.',
            'meters_square.integer' => 'Il numero di metri quadrati deve essere un numero intero.',
            'meters_square.min' => 'Il numero di metri quadrati deve essere almeno 1.',
    
            'address.required' => "L'indirizzo è obbligatorio.",
            'address.min' => "L'indirizzo deve avere almeno 5 caratteri.",
    
            'latitude.required' => 'La latitudine è obbligatoria.',
            'latitude.numeric' => 'La latitudine deve essere un numero.',
            'latitude.min' => 'La latitudine deve essere almeno 1.',
    
            'longitude.required' => 'La longitudine è obbligatoria.',
            'longitude.numeric' => 'La longitudine deve essere un numero.',
            'longitude.min' => 'La longitudine deve essere almeno 1.',
    
            'main_img.required' => "L'immagine principale è obbligatoria.",
            'main_img.image' => "L'immagine principale deve essere un'immagine.",
    
            'visible.required' => 'La visibilità è obbligatoria.',
            'visible.in' => 'La visibilità deve essere "si" o "no".',
    
            'description.required' => 'La descrizione è obbligatoria.',
            'description.min' => 'La descrizione deve avere almeno 20 caratteri.',
    
            'services.nullable' => 'Il servizio è opzionale.',
            'services.exists' => 'Il servizio selezionato non è valido.',

            'photos.image' => "Le foto della galleria devono essere un'immagine.",
        ];
    }
    
}
