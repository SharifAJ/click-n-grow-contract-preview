<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\BlogPost;
use App\Models\GalleryItem;

class PageController extends Controller
{
    public function home()
    {
        return $this->contract();
    }

    public function showSingleServicePage($service)
    {
        return view("pages.services.$service");
    }

    public function contract()
    {
        $datas = Crop::query()->orderBy('name')->get();

        $fallbackCrops = [
            'Akarkara' => 'client-assets/crop-roots.jpg',
            'Amla' => 'amla.jpg',
            'Ashwagandha' => 'client-assets/crop-ashwagandha.jpg',
            'Black Turmeric' => 'client-assets/crop-turmeric.jpg',
            'Chia Seeds' => 'client-assets/crop-seedlings.jpg',
            'Kalmegh' => 'client-assets/crop-herb-rows.jpg',
            'Moringa' => 'moringa.jpg',
            'Pippli' => 'client-assets/crop-pepper.jpg',
            'Quinoa' => 'crops.jpg',
            'Safed Musli' => 'client-assets/crop-harvest.jpg',
            'Sarpagandha' => 'client-assets/crop-green-leaves.jpg',
            'Stevia' => 'client-assets/crop-green-leaves.jpg',
            'Tulsi' => 'client-assets/crop-tulsi.jpg',
            'Yellow Shatavari' => 'shatavari.jpg',
        ];
        $existingCropNames = $datas->map(fn (Crop $crop) => mb_strtolower(trim($crop->name)))->all();

        foreach ($fallbackCrops as $name => $image) {
            if (in_array(mb_strtolower($name), $existingCropNames, true)) {
                continue;
            }

            $crop = new Crop([
                'name' => $name,
                'description' => 'Contract farming support and crop guidance from Click-N-Grow.',
                'details' => 'Contact our team to confirm crop suitability, current availability and growing guidance for your location.',
            ]);
            $crop->setAttribute('display_image', asset('images/' . $image));
            $datas->push($crop);
        }

        $datas->each(function (Crop $crop) {
            if (!$crop->getAttribute('display_image')) {
                $image = is_array($crop->images) ? ($crop->images[0] ?? null) : null;
                $crop->setAttribute('display_image', $image
                    ? asset('storage/' . $image)
                    : asset('images/' . ($crop->name === 'Tulsi' ? 'tulsi.webp' : 'client-assets/crop-herb.jpg')));
            }
        });
        $datas = $datas->sortBy('name')->values();

        $galleryItems = GalleryItem::query()->where('is_published', true)->orderBy('sort_order')->orderByDesc('id')->take(12)->get();
        $newsPosts = BlogPost::query()->where('is_published', true)->orderByDesc('published_at')->orderByDesc('id')->take(3)->get();

        return view('pages.contract', compact('datas', 'galleryItems', 'newsPosts'));
    }

    public function tradingExport()
    {
        $crops = Crop::query()->orderBy('name')->get();

        return view('pages.trading-and-export', compact('crops'));
    }
}
