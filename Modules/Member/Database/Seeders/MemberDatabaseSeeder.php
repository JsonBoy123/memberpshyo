<?php

namespace Modules\Member\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MemberDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $qualifcaitons = [

            ['qual_catg_code' => '1', 'qual_catg_desc' => '10th ','shrt_desc' => '10th'],
            ['qual_catg_code' => '2', 'qual_catg_desc' => '12th ','shrt_desc' => '12th'],
            ['qual_catg_code' => '3', 'qual_catg_desc' => 'Post Graduate','shrt_desc' => 'PG'],
            ['qual_catg_code' => '4', 'qual_catg_desc' => 'Under Graduate','shrt_desc' => 'UG'],
            ['qual_catg_code' => '5', 'qual_catg_desc' => 'Diploma','shrt_desc' => 'Diplo'],
            ['qual_catg_code' => '6', 'qual_catg_desc' => 'Certificate''shrt_desc' => 'Certi'],
        ];
        
        // $this->call("OthersTableSeeder");
    }
}
