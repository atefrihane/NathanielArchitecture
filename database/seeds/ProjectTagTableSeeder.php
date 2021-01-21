<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProjectTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_tag')->delete();

        $json = File::get('database/data/projects_tags.json');
        $ptags = json_decode($json);

        foreach ($ptags as $ptag) {
            foreach ($ptag->tags as $tag) {
                DB::table('project_tag')->insert([
                    'project_id' => $ptag->project_id,
                    'tag_id' => $tag
                ]);
            }
        }
    }
}
