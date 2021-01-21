<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->delete();

        $json = File::get('database/data/tags.json');
        $tags = json_decode($json);

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag->name
            ]);
        }
    }
}
