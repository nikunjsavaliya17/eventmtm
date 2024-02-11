<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            [
                'title' => 'Contact Mobile',
                'identifier' => 'contact_mobile',
                'value' => '+91 7845124578',
            ],
            [
                'title' => 'Contact Email',
                'identifier' => 'contact_email',
                'value' => 'info@company.com',
            ],
            [
                'title' => 'Contact Address',
                'identifier' => 'contact_address',
                'value' => 'Test Address',
            ],
            [
                'title' => 'Google Map Link',
                'identifier' => 'contact_map_link',
                'value' => '',
            ],
        ];
        foreach ($records as $record){
            $dataExist = Configuration::where('identifier', $record['identifier'])->first();
            if (is_null($dataExist)){
                Configuration::create($record);
            }
        }
    }
}
