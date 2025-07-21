<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'microfinance_id',
        'first_name',
        'last_name',
        'id_number',
        'phone',
        'email',
        'address',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the microfinance that the member belongs to.
     */
    public function microfinance(): BelongsTo
    {
        return $this->belongsTo(Microfinance::class);
    }

    /**
     * Get the loans for the member.
     */
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Get the pending loans for the member.
     */
    public function pendingLoans(): HasMany
    {
        return $this->hasMany(Loan::class)->where('status', 'Pending');
    }

    /**
     * Check if member has any pending loans.
     */
    public function hasPendingLoan(): bool
    {
        return $this->pendingLoans()->exists();
    }

    /**
     * Get full name attribute.
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Scope for active members.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    /**
     * Scope for pending members.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'Pending');
    }
}
