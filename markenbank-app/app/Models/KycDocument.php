<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KycDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'file_path',
        'status',
        'reviewed_by',
        'review_notes',
    ];

    /**
     * Get the user that owns the KYC document.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the reviewer of the document.
     */
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Verify document.
     */
    public function verify(int $reviewerId, string $notes = null): void
    {
        $this->status = 'verified';
        $this->reviewed_by = $reviewerId;
        $this->review_notes = $notes;
        $this->save();
    }

    /**
     * Reject document.
     */
    public function reject(int $reviewerId, string $notes): void
    {
        $this->status = 'rejected';
        $this->reviewed_by = $reviewerId;
        $this->review_notes = $notes;
        $this->save();
    }
}
