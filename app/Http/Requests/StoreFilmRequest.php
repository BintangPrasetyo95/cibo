<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFilmRequest extends FormRequest
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
            'judul' => ['required', 'string', 'max:150'],
            'genre' => ['required', 'string', 'max:60'],
            'durasi_menit' => ['required', 'integer', 'min:1', 'max:600'],
            'usia_rating' => ['required', 'string', 'in:SU,13+,17+,21+'],
            'sinopsis' => ['required', 'string'],
            'status_tayang' => ['required', 'string', 'in:segera,tayang,selesai'],
        ];
    }

    /**
     * Pesan kesalahan khusus bahasa Indonesia.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'judul.required' => 'Judul film wajib diisi.',
            'judul.max' => 'Judul film maksimal 150 karakter.',
            'genre.required' => 'Genre film wajib diisi.',
            'durasi_menit.required' => 'Durasi film wajib diisi.',
            'durasi_menit.integer' => 'Durasi harus berupa angka menit.',
            'durasi_menit.min' => 'Durasi film minimal 1 menit.',
            'usia_rating.required' => 'Rating usia wajib dipilih.',
            'usia_rating.in' => 'Rating usia harus salah satu dari: SU, 13+, 17+, atau 21+.',
            'sinopsis.required' => 'Sinopsis film wajib diisi.',
            'status_tayang.required' => 'Status penayangan wajib dipilih.',
            'status_tayang.in' => 'Status penayangan harus salah satu dari: segera, tayang, atau selesai.',
        ];
    }
}
