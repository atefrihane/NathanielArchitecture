<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Project;
use Carbon\Carbon;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->delete();

        $json = File::get('database/data/projects.json');
        $projects = json_decode($json);

        foreach ($projects as $project) {
            Project::create([
                'name' => $project->name,
                'architect' => $project->architect,
                'location' => $project->location,
                'date' => Carbon::createFromFormat('d-m-Y', $project->date)
            ]);
        }
    }
}
