<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'code',
        'title',
        'description',
        'start_at',
        'end_at',
        'location',
        'capacity',
        'status',
        'poster_path',
        'registered_count',
    ];

    protected function casts(): array
    {
        return [
            'start_at' => 'datetime',
            'end_at' => 'datetime',
            'capacity' => 'integer',
            'registered_count' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function scopeSearch(Builder $query, ?string $keyword): Builder
    {
        return $query->when($keyword, function (Builder $q, string $search) {
            $q->where(function (Builder $sub) use ($search) {
                $sub->where('title', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            });
        });
    }

    public function scopeFilterCategory(Builder $query, ?string $categoryId): Builder
    {
        return $query->when($categoryId, function (Builder $q, string $id) {
            $q->where('category_id', $id);
        });
    }

    public function scopeFilterStatus(Builder $query, ?string $status): Builder
    {
        return $query->when($status, function (Builder $q, string $st) {
            $q->where('status', $st);
        });
    }

    public function scopeSortByDate(Builder $query, ?string $direction = 'newest'): Builder
    {
        $dir = ($direction === 'oldest') ? 'asc' : 'desc';
        return $query->orderBy('start_at', $dir);
    }
}