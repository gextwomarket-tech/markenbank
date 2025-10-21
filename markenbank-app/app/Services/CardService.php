<?php

namespace App\Services;

use App\Models\VirtualCard;
use Illuminate\Support\Facades\Crypt;

class CardService
{
    /**
     * Generate a new virtual card
     */
    public function generateCard(int $userId, int $bankAccountId): VirtualCard
    {
        $cardNumber = generateCardNumber();
        $cvv = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $expiry = date('m/y', strtotime('+3 years'));
        
        return VirtualCard::create([
            'user_id' => $userId,
            'bank_account_id' => $bankAccountId,
            'card_number' => Crypt::encryptString($cardNumber),
            'card_number_masked' => maskCardNumber($cardNumber),
            'card_expiry' => $expiry,
            'card_cvv' => Crypt::encryptString($cvv),
            'card_cvv_masked' => '***',
            'card_type' => 'virtual',
            'status' => 'active', // or 'pending' if approval needed
        ]);
    }

    /**
     * Freeze a card
     */
    public function freezeCard(int $cardId): VirtualCard
    {
        $card = VirtualCard::findOrFail($cardId);
        $card->update(['status' => 'frozen']);
        
        logActivity('card_frozen', $card);
        
        return $card->fresh();
    }

    /**
     * Activate a card
     */
    public function activateCard(int $cardId): VirtualCard
    {
        $card = VirtualCard::findOrFail($cardId);
        $card->update(['status' => 'active']);
        
        logActivity('card_activated', $card);
        
        return $card->fresh();
    }

    /**
     * Cancel a card
     */
    public function cancelCard(int $cardId): VirtualCard
    {
        $card = VirtualCard::findOrFail($cardId);
        $card->update(['status' => 'cancelled']);
        
        logActivity('card_cancelled', $card);
        
        return $card->fresh();
    }

    /**
     * Reveal card number
     */
    public function revealCardNumber(VirtualCard $card): string
    {
        return Crypt::decryptString($card->card_number);
    }

    /**
     * Reveal CVV
     */
    public function revealCvv(VirtualCard $card): string
    {
        return Crypt::decryptString($card->card_cvv);
    }
}
