<?php

namespace Picpocket\Transaction\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Picpocket\Transaction\DTO\CreateTransactionDTO;

/**
 * Class CreateTransactionRequest
 *
 * Handles validation and transformation of transaction creation requests.
 *
 * Author: Victor Silva
 * Email: dev.jvictor@gmail.com
 * GitHub: github.com/golden-sheep
 */
class CreateTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return true
     */
    public function authorize(): true
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'payer_id' => ['required', 'exists:wallets,id'],
            'payee_id' => ['required', 'exists:wallets,id'],
            'amount' => ['required', 'integer']
        ];
    }

    /**
     * Transform the request data into a CreateTransactionDTO instance.
     *
     * @return CreateTransactionDTO
     */
    public function toDTO(): CreateTransactionDTO
    {
        return new CreateTransactionDTO(
            payerId: $this->input('payer_id'),
            payeeId: $this->input('payee_id'),
            amount: $this->input('amount')
        );
    }
}
