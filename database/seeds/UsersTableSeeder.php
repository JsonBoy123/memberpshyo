<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
use App\Permission;
use App\Models\Specialization;
class UsersTableSeeder extends Seeder
{
    
    public function run()
    {
    	Role::create(
    		[
	    		'id'             => '1',
	    		'name'           => 'super_admin',
	    		'display_name'   => 'Super Admin',
	    		'description'    => 'User can manage all the access of sites.'
    		]    		
    	);
        Role::create(
            [
                'id'            => '2',
                'name'          => 'admin',
                'display_name'  => 'Admin',
                'description'   => 'User can manage admin panel.'
            ]       
        );
        Role::create(
            [
                'id'            => '3',
                'name'          => 'member',
                'display_name'  => 'Memebr',
                'description'   => 'User can manage member panel.'
            ]       
        );

        $user = User::create([
        	'name'              => 'Site Admin',
        	'email'             => 'siteadmin@physiotherapy.org',
            'phone'             => '7440561956',
        	'password'          => Hash::make('siteadmin'),
            'email_verified_at' => date('Y-m-d H:i:s'),
            'phone_verified_at' => date('Y-m-d H:i:s'),
        ]);

        $user->attachRole('1');

        $specializations = [
            ['id' => '1', 'name' => 'Cardiovascular and pulmonary physiotherapy'],
            ['id' => '2', 'name' => 'Clinical electrophysiology'],
            ['id' => '3', 'name' => 'Geriatric'],
            ['id' => '4', 'name' => 'Integumentary'],
            ['id' => '5', 'name' => 'Neurological'],
            ['id' => '6', 'name' => 'Orthopedic'],
            ['id' => '7', 'name' => 'Pediatric'],
            ['id' => '8', 'name' => 'Sports'],
            ['id' => '9', 'name' => 'Community Physiotherapy'],
            ['id' => '10', 'name' => "Women's health"],
            ['id' => '11', 'name' => 'Palliative care'],
            ['id' => '12', 'name' => 'Back pain']
        ];
        foreach ($specializations as $specialization) {
          Specialization::create($specialization);
        }
    }
}
