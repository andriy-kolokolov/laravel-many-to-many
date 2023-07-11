<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed projects table
        DB::table('projects')->insert([
            [
                'title' => 'boolzap',
                'description' => 'Whatsup clone using VUE JS',
                'project_url' => 'https://github.com/andriy-kolokolov/vue-boolzapp',
            ],
            [
                'title' => 'Java CRUD and tests',
                'description' => 'Used DAO (Data Access Object) Pattern. CRUD methods and tests JAVA HIBERNATE',
                'project_url' => 'https://github.com/andriy-kolokolov/java-hibernate-jdbc-database-manager',
            ],
            [
                'title' => 'Java Roman Calculator',
                'description' => 'Just a simple Roman calculator using a hashmap to convert an integer to a Roman numeral. Inspired to create it after completing the LeetCode task "https://leetcode.com/problems/roman-to-integer/"',
                'project_url' => 'https://github.com/andriy-kolokolov/java-roman-calculator',
            ],
            [
                'title' => 'Todo List Teamwork',
                'description' => 'This project focuses on teamwork and GIT version control. This is a Simple Todo List manager. ',
                'project_url' => 'https://github.com/alessandropecchini99/laravel-boolean',
            ],
        ]);

        // Seed project_programming_languages table
        DB::table('projects_programming_languages')->insert([
            [
                'programming_language' => 'JS',
            ],
            [
                'programming_language' => 'HTML',
            ],
            [
                'programming_language' => 'SASS',
            ],
            [
                'programming_language' => 'Java',
            ],
            [
                'programming_language' => 'Java',
            ],
            [
                'programming_language' => 'Blade',
            ],
            [
                'programming_language' => 'PHP',
            ],
        ]);

        // Seed project_frameworks table
        DB::table('projects_frameworks')->insert([
            [
                'project_id' => 1,
                'framework' => 'Vue.js',
            ],
            [
                'project_id' => 2,
                'framework' => 'Hibernate',
            ],
            [
                'project_id' => 2,
                'framework' => 'MySQL',
            ],
            [
                'project_id' => 2,
                'framework' => 'Maven',
            ],
            [
                'project_id' => 2,
                'framework' => 'JDBC',
            ],
            [
                'project_id' => 4,
                'framework' => 'Laravel',
            ],
            [
                'project_id' => 4,
                'framework' => 'Bootstrap',
            ],
        ]);

        // Seed relational table 'project_language'
        DB::table('project_language')->insert([
            [
                'project_id' => 1,
                'language_id' => 1,
            ],
            [
                'project_id' => 1,
                'language_id' => 2,
            ],
            [
                'project_id' => 1,
                'language_id' => 3,
            ],
            [
                'project_id' => 2,
                'language_id' => 4,
            ],
            [
                'project_id' => 3,
                'language_id' => 4,
            ],
            [
                'project_id' => 4,
                'language_id' => 6,
            ],
            [
                'project_id' => 4,
                'language_id' => 7,
            ],
        ]);

        // Seed project_types table
        DB::table('project_types')->insert([
            [
                'project_id' => 1,
                'type' => 'Front End',
            ],
            [
                'project_id' => 2,
                'type' => 'Back End',
            ],
            [
                'project_id' => 3,
                'type' => 'Back End',
            ],
            [
                'project_id' => 4,
                'type' => 'Web App Dev',
            ],
            [
                'project_id' => 4,
                'type' => 'Full Stack',
            ],
        ]);
    }
}
