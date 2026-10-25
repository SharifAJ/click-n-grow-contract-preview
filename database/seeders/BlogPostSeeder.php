<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'slug' => 'sample-ashwagandha-cultivation',
                'title' => 'Getting Started with Ashwagandha Cultivation',
                'excerpt' => 'A sample introduction to planning an ashwagandha crop, from choosing a suitable field to preparing for harvest.',
                'content' => "Ashwagandha is an important medicinal crop that can offer farmers another option to explore. Successful cultivation starts with understanding local soil, climate, water availability, and the needs of a potential buyer.\n\nBefore planting, growers should seek region-specific agronomic advice and use quality planting material. This sample article is for demonstration only and is not a crop-specific cultivation recommendation.",
                'thumbnail' => 'images/ashwagandha.webp',
                'image_name' => 'sample-ashwagandha.webp',
                'published_at' => now()->subDays(3),
            ],
            [
                'slug' => 'sample-moringa-value-chain',
                'title' => 'Moringa: Connecting Farm Production to Market Needs',
                'excerpt' => 'See how crop planning, quality handling, and buyer requirements fit together in a more organized medicinal plant supply chain.',
                'content' => "A reliable crop-to-market journey involves more than growing a crop. Farmers and buyers benefit when production plans, quality expectations, harvesting, and post-harvest handling are discussed in advance.\n\nThis sample article introduces the value-chain approach. Actual crop selection and procurement depend on local conditions and mutually agreed terms.",
                'thumbnail' => 'images/moringa.jpg',
                'image_name' => 'sample-moringa.jpg',
                'published_at' => now()->subDays(2),
            ],
            [
                'slug' => 'sample-amla-farm-planning',
                'title' => 'Planning an Amla Opportunity for Your Farm',
                'excerpt' => 'A sample guide to the early questions growers can consider when exploring amla and other medicinal plant opportunities.',
                'content' => "Every farm has its own strengths. Land characteristics, water access, available labour, and the farmer's goals all matter when considering a new crop such as amla.\n\nA good first step is to discuss suitability and market requirements with knowledgeable local partners before making an investment. This sample article is provided to demonstrate the blog and does not guarantee crop performance or a purchase.",
                'thumbnail' => 'images/amla.jpg',
                'image_name' => 'sample-amla.jpg',
                'published_at' => now()->subDay(),
            ],
        ];

        foreach ($posts as $post) {
            $existingPost = BlogPost::query()->where('slug', $post['slug'])->first();
            if ($existingPost && str_starts_with($existingPost->title, '[Sample] ')) {
                $existingPost->update([
                    'title' => substr($existingPost->title, strlen('[Sample] ')),
                ]);
            }

            $sourcePath = public_path($post['thumbnail']);
            if (! File::isFile($sourcePath)) {
                throw new RuntimeException("Sample blog thumbnail not found: {$post['thumbnail']}");
            }

            $thumbnailPath = 'blogs/' . $post['image_name'];
            if (! Storage::disk('public')->exists($thumbnailPath)
                && ! Storage::disk('public')->put($thumbnailPath, File::get($sourcePath))) {
                throw new RuntimeException("Unable to store sample blog thumbnail: {$thumbnailPath}");
            }

            BlogPost::firstOrCreate(
                ['slug' => $post['slug']],
                [
                    'title' => $post['title'],
                    'excerpt' => $post['excerpt'],
                    'content' => $post['content'],
                    'thumbnail_path' => $thumbnailPath,
                    'is_published' => true,
                    'published_at' => $post['published_at'],
                ],
            );
        }
    }
}
