<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        //General Category
        DB::table('categories')->insert([
            'title' => 'General',
            'description' => null,
            'slug' => 'general',
            'weight' => 1,
            'isLocked' => false,
            'isPrivate' => false,
        ]);

        DB::table('categories')->insert([
            'title' => 'News And Announcements',
            'description' => 'Important Information about the server will be posted here.',
            'slug' => 'news-and-announcements',
            'parent_id' => 1,
            'weight' => 1,
            'isLocked' => true,
            'isPrivate' => false,
        ]);

        DB::table('categories')->insert([
            'title' => 'Rules',
            'description' => 'Here you will find all the rules for ASAP.',
            'slug' => 'rules',
            'parent_id' => 1,
            'weight' => 2,
            'isLocked' => true,
            'isPrivate' => false,
        ]);

        DB::table('categories')->insert([
            'title' => 'Introductions',
            'description' => 'Introduce yourself to the ASAP community to better know each-other.',
            'slug' => 'introductions',
            'parent_id' => 1,
            'weight' => 3,
            'isLocked' => false,
            'isPrivate' => false,
        ]);

        DB::table('categories')->insert([
            'title' => 'General Discussion',
            'description' => 'You can talk about anything here to other people.',
            'slug' => 'general-discussion',
            'parent_id' => 1,
            'weight' => 4,
            'isLocked' => false,
            'isPrivate' => false,
        ]);

        DB::table('categories')->insert([
            'title' => 'Server Suggestions',
            'description' => 'Suggest new features for the server here.',
            'slug' => 'server-suggestions',
            'parent_id' => 1,
            'weight' => 5,
            'isLocked' => false,
            'isPrivate' => false,
        ]);
        // General Category


        //ASAP DARKRP
        DB::table('categories')->insert([
            'title' => 'DarkRP Staff Applications',
            'description' => null,
            'slug' => 'darkrp-staff-applications',
            'weight' => 1,
            'isLocked' => false,
            'isPrivate' => false,
        ]);
        DB::table('categories')->insert([
            'title' => 'Staff Applications',
            'description' => null,
            'slug' => 'staff-applications',
            'weight' => 1,
            'parent_id' => 7,
            'isLocked' => false,
            'isPrivate' => false,
        ]);

        DB::table('categories')->insert([
            'title' => 'DarkRP Accepted Applications',
            'description' => null,
            'slug' => 'darkrp-accepted-applications',
            'weight' => 1,
            'parent_id' => 7,
            'isLocked' => true,
            'isPrivate' => false,
        ]);

        DB::table('categories')->insert([
            'title' => 'DarkRP Denied Applications',
            'description' => null,
            'slug' => 'darkrp-denied-applications',
            'weight' => 2,
            'parent_id' => 7,
            'isLocked' => true,
            'isPrivate' => false,
        ]);

        DB::table('categories')->insert([
            'title' => 'Resolution Centre',
            'description' => null,
            'slug' => 'resolution-centre',
            'weight' => 1,
            'isLocked' => false,
            'isPrivate' => false,
        ]);


        DB::table('categories')->insert([
            'title' => 'Staff Reports',
            'description' => null,
            'slug' => 'staff-reports',
            'weight' => 1,
            'parent_id' => 11,
            'isLocked' => false,
            'isPrivate' => false,
        ]);

        DB::table('categories')->insert([
            'title' => 'Resolved DarkRP Staff Reports',
            'description' => null,
            'slug' => 'resolved-darkrp-staff-reports',
            'weight' => 2,
            'parent_id' => 11,
            'isLocked' => true,
            'isPrivate' => false,
        ]);

        DB::table('categories')->insert([
            'title' => 'Unban Appeals',
            'description' => null,
            'slug' => 'unban-appeals',
            'weight' => 3,
            'parent_id' => 11,
            'isLocked' => false,
            'isPrivate' => false,
        ]);

        DB::table('categories')->insert([
            'title' => 'Resolved DarkRP Unban Appeals',
            'description' => null,
            'slug' => 'resolved-darkrp-unban-appeals',
            'weight' => 4,
            'parent_id' => 11,
            'isLocked' => true,
            'isPrivate' => false,
        ]);
    }
}
