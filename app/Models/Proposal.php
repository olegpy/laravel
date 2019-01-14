<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Proposal extends Model
{
    const PAGINATE_PAGE_COUNT=5;

    use Notifiable;

    const PROPOSAL_READED = 1;
    const PROPOSAL_NOT_READED = 0;

    const PROPOSAL_READ_STATUSES = [
        self::PROPOSAL_READED,
        self::PROPOSAL_NOT_READED,
    ];

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'attached_file',
        'readed',
    ];

    /**
     * Get the post that owns the comment.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
