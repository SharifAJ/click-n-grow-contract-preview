<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id();
            $table->string('title', 180);
            $table->string('caption', 500)->nullable();
            $table->string('image_path');
            $table->boolean('is_published')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $now = now();
        $items = [
            ['Farmers sharing field experience', 'Community gathering with local growers.', 'images/client-assets/gallery-farmer-meeting.jpg'],
            ['Learning together in the field', 'A crop visit brings farmers and advisors together.', 'images/client-assets/gallery-field-visit.jpg'],
            ['Farmer training session', 'A learning session focused on practical farming support.', 'images/client-assets/gallery-training.jpg'],
            ['Field visit with growers', 'On-ground discussions in a cultivated field.', 'images/client-assets/gallery-farmers-in-field.jpg'],
            ['Knowledge exchange with farmers', 'A community session for sharing crop guidance.', 'images/client-assets/gallery-farmer-session.jpg'],
            ['Community farmer meeting', 'Growers come together for an information session.', 'images/client-assets/gallery-community-meeting.jpg'],
            ['Working with farmer groups', 'A group meeting with local farming partners.', 'images/client-assets/gallery-farmer-group.jpg'],
            ['Connecting growers and markets', 'A look at produce moving through local markets.', 'images/client-assets/gallery-produce-market.jpg'],
            ['Team field visit', 'The team meets growers and reviews their fields.', 'images/client-assets/gallery-team-visit.jpg'],
            ['Community event', 'A farmer event recognizing community participation.', 'images/client-assets/gallery-event.jpg'],
            ['Workshop and discussion', 'Farmers and partners take part in a workshop.', 'images/client-assets/gallery-workshop.jpg'],
            ['Community discussion', 'A group discussion with farming partners.', 'images/client-assets/gallery-community-discussion.jpg'],
        ];

        foreach ($items as $order => [$title, $caption, $image]) {
            DB::table('gallery_items')->insert([
                'title' => $title,
                'caption' => $caption,
                'image_path' => $image,
                'is_published' => true,
                'sort_order' => $order + 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_items');
    }
};
