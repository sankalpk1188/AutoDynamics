<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Support\AchievementDefaults;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Image;

class AchievementController extends Controller
{
    private const TYPES = [
        'award' => 'Award',
        'certification' => 'Certification',
        'patent' => 'Patent',
        'design_registration' => 'Design Registration',
    ];

    public function addAchievement(Request $request)
    {
        if ($request->isMethod('post')) {
            if (!Schema::hasTable('achievements')) {
                return redirect()->back()->with('flash_message_error', 'Achievements table missing. Please run migrations.');
            }

            $data = $request->validate([
                'type' => 'required|in:award,certification,patent,design_registration',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'alt' => 'nullable|string|max:255',
                'identifier' => 'nullable|string|max:120',
                'sort_order' => 'nullable|integer|min:0|max:9999',
                'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
                'status' => 'nullable|in:0,1',
            ]);

            $achievement = new Achievement();
            $achievement->type = $data['type'];
            $achievement->title = $data['title'];
            $achievement->description = $data['description'] ?? null;
            $achievement->alt = $data['alt'] ?? null;
            $achievement->identifier = $data['identifier'] ?? null;
            $achievement->sort_order = $data['sort_order'] ?? 0;
            $achievement->status = !empty($data['status']) ? 1 : 0;
            $achievement->image = $this->storeImage($request->file('image'));

            $achievement->save();

            return redirect('admin/view-achievements/')->with('flash_message_success', 'Award / certification added successfully');
        }

        return view('admin.achievements.add_achievement', [
            'types' => self::TYPES,
        ]);
    }

    public function editAchievement(Request $request, $id)
    {
        if (!Schema::hasTable('achievements')) {
            return redirect()->back()->with('flash_message_error', 'Achievements table missing. Please run migrations.');
        }

        $achievement = Achievement::find($id);
        if (!$achievement) {
            return redirect('admin/view-achievements')->with('flash_message_error', 'Record not found.');
        }

        if ($request->isMethod('post')) {
            $data = $request->validate([
                'type' => 'required|in:award,certification,patent,design_registration',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'alt' => 'nullable|string|max:255',
                'identifier' => 'nullable|string|max:120',
                'sort_order' => 'nullable|integer|min:0|max:9999',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
                'status' => 'nullable|in:0,1',
            ]);

            $filename = $achievement->image;
            if ($request->hasFile('image')) {
                $filename = $this->storeImage($request->file('image'));
            } elseif (!empty($request->input('current_image'))) {
                $filename = $request->input('current_image');
            }

            $achievement->update([
                'type' => $data['type'],
                'title' => $data['title'],
                'description' => $data['description'] ?? null,
                'alt' => $data['alt'] ?? null,
                'identifier' => $data['identifier'] ?? null,
                'sort_order' => $data['sort_order'] ?? 0,
                'status' => !empty($data['status']) ? 1 : 0,
                'image' => $filename,
            ]);

            return redirect('admin/view-achievements')->with('flash_message_success', 'Award / certification updated successfully');
        }

        return view('admin.achievements.edit_achievement', [
            'achievement' => $achievement,
            'types' => self::TYPES,
        ]);
    }

    public function deleteAchievement(Request $request, $id)
    {
        if (Schema::hasTable('achievements')) {
            Achievement::where('id', $id)->delete();
        }

        return redirect()->back()->with('flash_message_success', 'Award / certification deleted successfully');
    }

    public function viewAchievements(Request $request)
    {
        if (!Schema::hasTable('achievements')) {
            return view('admin.achievements.view_achievements', [
                'achievements' => collect(),
                'types' => self::TYPES,
            ])->with('flash_message_error', 'Achievements table missing. Please run migrations.');
        }

        $achievements = Achievement::query()
            ->when($request->type, fn ($query) => $query->where('type', $request->type))
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(30)
            ->appends($request->query());

        return view('admin.achievements.view_achievements', [
            'achievements' => $achievements,
            'types' => self::TYPES,
        ]);
    }

    public function importDefaults(Request $request)
    {
        if (!Schema::hasTable('achievements')) {
            return redirect()->back()->with('flash_message_error', 'Achievements table missing. Please run migrations.');
        }

        if (Achievement::count() > 0) {
            return redirect()->back()->with('flash_message_error', 'Import skipped because awards already exist.');
        }

        $now = now();
        foreach (AchievementDefaults::items() as $item) {
            Achievement::create([
                'type' => $item['type'],
                'title' => $item['title'],
                'description' => $item['description'],
                'alt' => $item['alt'],
                'identifier' => $item['identifier'],
                'image' => $item['image'],
                'sort_order' => $item['sort_order'],
                'status' => $item['status'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        return redirect('admin/view-achievements')->with('flash_message_success', 'Default awards imported successfully');
    }

    private function storeImage($file): string
    {
        $extension = $file->getClientOriginalExtension();
        $filename = rand(1111, 99999999) . '.' . $extension;
        $uploadDir = public_path('assets/images/awards');

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        Image::make($file)->save($uploadDir . DIRECTORY_SEPARATOR . $filename);

        return $filename;
    }
}
