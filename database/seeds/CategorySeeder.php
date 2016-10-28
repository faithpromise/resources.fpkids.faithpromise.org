<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categories')->truncate();

        DB::table('categories')->insert(['name' => 'Family Registration Resources', 'description' => 'Items needed for Family Registration area.']);
        DB::table('categories')->insert(['name' => 'SGL Contact Tools', 'description' => 'Ways your SGLs can "show up randomly" in a kids\' life.']);
        DB::table('categories')->insert(['name' => 'Baptism Class Resources', 'description' => 'Baptism Class booklets for kids participating in the Baptism process. There are two types of workbook: Young Elementary (K-2nd) & Old Elementary (3rd-5th).']);
        DB::table('categories')->insert(['name' => 'Volunteer & KidRave T-shirts']);
        DB::table('categories')->insert(['name' => 'Volunteer Resources', 'description' => 'Print resources needed to equip your volunteer team.']);
        DB::table('categories')->insert(['name' => 'Environment Needs', 'description' => 'Items used in fpKIDS environments.']);
        DB::table('categories')->insert(['name' => 'Childcare Team Needs']);
        DB::table('categories')->insert(['name' => 'Promotional Tools', 'description' => 'Items needed to promote fpKIDS ministry and events.']);
    }
}
