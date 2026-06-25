<?php

namespace App\Models;

use App\Support\AchievementDefaults;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $table = 'achievements';

    protected $fillable = [
        'type',
        'title',
        'description',
        'alt',
        'identifier',
        'image',
        'sort_order',
        'status',
    ];

    public function imageUrl(): string
    {
        if (empty($this->image)) {
            return '';
        }

        if (str_starts_with($this->image, 'http') || str_starts_with($this->image, 'assets/')) {
            return asset($this->image);
        }

        return asset('assets/images/awards/' . $this->image);
    }

    public function toDisplayArray(): array
    {
        $item = [
            'type' => $this->type,
            'title' => $this->title,
            'image' => str_starts_with((string) $this->image, 'assets/')
                ? $this->image
                : 'assets/images/awards/' . $this->image,
            'alt' => $this->alt ?: $this->title,
            'description' => $this->description ?? '',
        ];

        if (!empty($this->identifier)) {
            $item['identifier'] = $this->identifier;
        }

        return $item;
    }

    public static function publishedForHomepage(): array
    {
        return static::query()
            ->where('status', 1)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get()
            ->map(fn (self $achievement) => $achievement->toDisplayArray())
            ->values()
            ->all();
    }

    public static function fallbackDisplayItems(): array
    {
        return AchievementDefaults::displayItems();
    }
}
