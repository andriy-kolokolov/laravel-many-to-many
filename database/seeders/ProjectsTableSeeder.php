<?php
namespace Database\Seeders;

use App\Models\Project\ProgrammingLanguage;
use App\Models\Project\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Front End'],
            ['name' => 'Back End'],
            ['name' => 'Full Stack'],
        ];
        DB::table('types')->insert($types);

        $programmingLanguages = [
            ['name' => 'JS'],
            ['name' => 'HTML'],
            ['name' => 'SASS'],
            ['name' => 'PHP'],
            ['name' => 'JAVA'],
        ];
        DB::table('programming_languages')->insert($programmingLanguages);

        $technologies = [
            ['name' => 'VUE.JS'],
            ['name' => 'HIBERNATE'],
            ['name' => 'MYSQL'],
            ['name' => 'MAVEN'],
            ['name' => 'JDBC'],
            ['name' => 'BOOTSTRAP'],
            ['name' => 'LARAVEL'],
        ];
        DB::table('technologies')->insert($technologies);

        // Seed projects table
        $projects = [
            [
                'title' => 'boolzap',
                'type_id' => 1,
                'slug' =>  Str::slug('boolzap'),
                'description' => 'Whatsup clone using VUE JS',
                'project_url' => 'https://github.com/andriy-kolokolov/vue-boolzapp',
            ],
            [
                'title' => 'Java CRUD and tests',
                'type_id' => 2,
                'slug' =>  Str::slug('Java CRUD and tests'),
                'description' => 'Used DAO (Data Access Object) Pattern. CRUD methods and tests JAVA HIBERNATE',
                'project_url' => 'https://github.com/andriy-kolokolov/java-hibernate-jdbc-database-manager',
            ],
            [
                'title' => 'Java Roman Calculator',
                'type_id' => 2,
                'slug' =>  Str::slug('Java Roman Calculator'),
                'description' => 'Just a simple Roman calculator using a hashmap to convert an integer to a Roman numeral. Inspired to create it after completing the LeetCode task "https://leetcode.com/problems/roman-to-integer/"',
                'project_url' => 'https://github.com/andriy-kolokolov/java-roman-calculator',
            ],
            [
                'title' => 'Todo List Teamwork',
                'type_id' => 3,
                'slug' => Str::slug('Todo List Teamwork'),
                'description' => 'This project focuses on teamwork and GIT version control. This is a Simple Todo List manager. ',
                'project_url' => 'https://github.com/alessandropecchini99/laravel-boolean',
            ],
        ];

//        for ($i = 0; $i < count($projects); $i++)
        foreach ($projects as $project){
            Project::create([
                'title' => $project['title'],
                'type_id' => $project['type_id'],
                'slug' => Str::slug($project['title']),
                'description' => $project['description'],
                'project_url' => $project['project_url'],
            ]);
        }

        $project1 = Project::find(1);
        $project2 = Project::find(2);
        $project3 = Project::find(3);
        $project4 = Project::find(4);

        $project1->programmingLanguages()->sync([1, 2, 3]);
        $project2->programmingLanguages()->sync(5);
        $project3->programmingLanguages()->sync(5);
        $project4->programmingLanguages()->sync([3, 4]);

        $project1->technologies()->sync([1, 6]);
        $project2->technologies()->sync([2, 3, 4, 5]);
        $project3->technologies()->sync(5);
        $project4->technologies()->sync([3, 6, 7]);

    }
}
