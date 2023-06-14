<?php

use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
        	'id' 	=> '1',
        	'name' 	=> 'IAP Award Application Form 2020',
        	'charges' => '10000',
        	'description' => null,
        	'service_type' => 'L',
        	
        ];
    }
}
