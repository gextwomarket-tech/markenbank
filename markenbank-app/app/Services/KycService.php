<?php

namespace App\Services;

use App\Models\KycDocument;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class KycService
{
    /**
     * Upload a KYC document
     */
    public function uploadDocument(int $userId, string $type, UploadedFile $file): KycDocument
    {
        $path = $file->store('kyc-documents', 'public');
        
        return KycDocument::create([
            'user_id' => $userId,
            'document_type' => $type,
            'file_path' => $path,
            'status' => 'pending',
        ]);
    }

    /**
     * Verify a document
     */
    public function verifyDocument(int $documentId, int $adminId, ?string $note = null): KycDocument
    {
        $document = KycDocument::findOrFail($documentId);
        
        $document->update([
            'status' => 'verified',
            'reviewed_by' => $adminId,
            'reviewed_at' => now(),
            'review_notes' => $note,
        ]);
        
        // Check if all documents are verified
        $this->checkUserVerification($document->user_id);
        
        // Log activity
        logActivity('kyc_verified', $document, [
            'admin_id' => $adminId,
            'document_type' => $document->document_type,
        ]);
        
        return $document->fresh();
    }

    /**
     * Reject a document
     */
    public function rejectDocument(int $documentId, int $adminId, string $note): KycDocument
    {
        $document = KycDocument::findOrFail($documentId);
        
        $document->update([
            'status' => 'rejected',
            'reviewed_by' => $adminId,
            'reviewed_at' => now(),
            'review_notes' => $note,
        ]);
        
        // Log activity
        logActivity('kyc_rejected', $document, [
            'admin_id' => $adminId,
            'reason' => $note,
        ]);
        
        return $document->fresh();
    }

    /**
     * Check if user's verification status should be updated
     */
    public function checkUserVerification(int $userId): void
    {
        $user = User::findOrFail($userId);
        
        $allDocuments = KycDocument::where('user_id', $userId)->get();
        
        if ($allDocuments->isEmpty()) {
            return;
        }
        
        // Check if all documents are verified
        $allVerified = $allDocuments->every(function ($doc) {
            return $doc->status === 'verified';
        });
        
        if ($allVerified && !$user->is_verified) {
            $user->update(['is_verified' => true]);
            
            // Send verification email
            // TODO: Implement email notification
            
            logActivity('user_verified', $user);
        }
    }
}
