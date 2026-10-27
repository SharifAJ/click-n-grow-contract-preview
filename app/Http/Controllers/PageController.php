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
        $legacyCropPdfs = [
            'Akarkara' => ['KFM4f24cs3y2kCEMC0ja0on1PCo55aGNlACaACJ9.pdf', 'wMsZpyIyl5weOAsWi8E7LciyL4QE8blwqvKGkFIi.pdf'],
            'Amla' => ['hveSy0Xg7jq8TV40084xC2Z5cBU4NwPwceFh0k6Z.pdf', '0EZdekaaNLHryTDoqKZxLWCRh9Ri2wAK8X9mImOD.pdf'],
            'Ashwagandha' => ['PoJx33zxjWNzvViKYUUyiozFSmTp6xl0w93omcJY.pdf', 'jEkk9SnVaIOu8k0zwCJdWyaNxP4zX27jKijz6sFS.pdf'],
            'Black Turmeric' => ['wLoPuLEL1UldAw1FEnKulOu1wkiHV0TqogFlPtZs.pdf', 'AAtATG0FpnCiKfrOmGHsxUbtxsjiGwFO0Uy4n49f.pdf'],
            'Chia Seeds' => ['d6I4BsU4RPO0qspQzlboPAMxtqigLwgwloK9nRCO.pdf', 'Od5NXLGh6Ppz2agn89t8SDaoegQf09lDtW3hbk1N.pdf'],
            'Kalmegh' => ['lqSBN2VFBrqDVWoBuC4g4sEVipiIkKv52l8OLPXt.pdf', 'ivFoJAwLxJO3LCKD9h1xdHOpY425c1lZtiEFiqHh.pdf'],
            'Moringa' => ['7vtWDSaM1mz9MAkIx7301xKvBMk9m493TkBrvbpY.pdf', 'vyhd7UAD5eW96ke2lXxxMjtsZFPVTnNLY1jdt5yg.pdf'],
            'Pippli' => ['pd3vuGbHGjLXBQj0gA3ymieqMKqGUKFpWtFO1lQS.pdf', null],
            'Quinoa' => ['V6s0GNMZf8pqZdH0TlqmADWtxd40PPM8JifvK3Mi.pdf', 'K0adjyA8byvG9tNvNFdN3ay0gva3W8dMjZpSHqcy.pdf'],
            'Safed Musli' => ['qtDGFsvENWbItK6HazxEXQ1NSp1VE5AjE9YG67Ti.pdf', 'lJaGaqNL2c7D4EYSVgHRt6PTkJHjjVv8QTd0ush3.pdf'],
            'Sarpagandha' => ['mwh8v3FeeoOyRwUVTivWbAEFhIQXCYVH7MaEZ4rd.pdf', 'Iz1pqHwrBHT5IHbeh3xd6lgd8y7MAkZhfDY6oE1k.pdf'],
            'Stevia' => ['E8RnzZNxa3IlauanEmzoyfNEJCnExsFAf719IVJk.pdf', 'EAnB1MJDsZbdwViUUwWB5sawB6eutelrzuNvdaPh.pdf'],
            'Tulsi' => ['MkzQ2AvpmBSDIskBUx1ofbQoc6bjZuZ04F9jvLBN.pdf', 'lQGPYWfbpxC3m2QMq6iln4BMBbRMGZKTerE9oTNR.pdf'],
            'Yellow Shatavari' => ['AAiC4IbpFytZUUw0ZAL0hIz1zLYwEBWejAPYpUHk.pdf', 'qQB8E9QIva0nZ0Cv9PzS4V3BTJv4jaFbgyvO5Ht2.pdf'],
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

        $datas->each(function (Crop $crop) use ($legacyCropPdfs) {
            $pdfNames = $legacyCropPdfs[$crop->name] ?? [null, null];
            $crop->setAttribute('fallback_pdf_en', $crop->pdf_en ? null : ($pdfNames[0] ? "https://kisansat.com/storage/pdfs/{$pdfNames[0]}" : null));
            $crop->setAttribute('fallback_pdf_hi', $crop->pdf_hi ? null : ($pdfNames[1] ? "https://kisansat.com/storage/pdfs/{$pdfNames[1]}" : null));
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
