<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 * @method static findOrFail($id)
 * @method static where(string $string, $userId)
 * @property mixed $id
 * @property mixed $subscribers
 * @property mixed $subject
 * @property mixed $content
 * @property mixed $status
 * @property mixed $type
 * @property mixed $variant
 * @property mixed $name
 * @property mixed $emailLogs
 */
class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'subject',
        'content',
        'type',
        'status',
        'scheduled_at',
        'variant',
        'is_winner',
    ];

    /**
     * @return BelongsToMany
     */
    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(Subscriber::class, 'campaign_subscriber');
    }

    /**
     * @return HasMany
     */
    public function emailLogs(): HasMany
    {
        return $this->hasMany(EmailLog::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

