<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Seed types table
        DB::table('types')->insert([
            ['name' => 'Front End'],
            ['name' => 'Back End'],
            ['name' => 'Full Stack'],
        ]);

        // Seed projects table
        $projects = [
            [
                'title' => 'boolzap',
                'type_id' => 1,
                'description' => 'Whatsup clone using VUE JS',
                'project_url' => 'https://github.com/andriy-kolokolov/vue-boolzapp',
            ],
            [
                'title' => 'Java CRUD and tests',
                'type_id' => 2,
                'description' => 'Used DAO (Data Access Object) Pattern. CRUD methods and tests JAVA HIBERNATE',
                'project_url' => 'https://github.com/andriy-kolokolov/java-hibernate-jdbc-database-manager',
            ],
            [
                'title' => 'Java Roman Calculator',
                'type_id' => 2,
                'description' => 'Just a simple Roman calculator using a hashmap to convert an integer to a Roman numeral. Inspired to create it after completing the LeetCode task "https://leetcode.com/problems/roman-to-integer/"',
                'project_url' => 'https://github.com/andriy-kolokolov/java-roman-calculator',
            ],
            [
                'title' => 'Todo List Teamwork',
                'type_id' => 3,
                'description' => 'This project focuses on teamwork and GIT version control. This is a Simple Todo List manager.',
                'project_url' => 'https://github.com/alessandropecchini99/laravel-boolean',
            ],
        ];

        foreach ($projects as $project) {
            $projectId = DB::table('projects')->insertGetId([
                'title' => $project['title'],
                'type_id' => $project['type_id'],
                'description' => $project['description'],
                'project_url' => $project['project_url'],
            ]);

            // Seed project_programming_languages table
            $programmingLanguages = [
                'JS',
                'HTML',
                'SASS',
            ];

            foreach ($programmingLanguages as $programmingLanguage) {
                $programmingLanguageId = DB::table('programming_languages')->insertGetId([
                    'name' => $programmingLanguage,
                ]);

                DB::table('project_programming_language')->insert([
                    'project_id' => $projectId,
                    'programming_language_id' => $programmingLanguageId,
                ]);
            }

            // Seed project_technology table
            $technologies = [
                'Vue.js',
                'Hibernate',
                'MySQL',
                'Maven',
                'JDBC',
                'Bootstrap',
            ];

            foreach ($technologies as $technology) {
                $technologyId = DB::table('technologies')->insertGetId([
                    'name' => $technology,
                ]);

                DB::table('project_technology')->insert([
                    'project_id' => $projectId,
                    'technology_id' => $technologyId,
                ]);
            }
        }
    }
}
