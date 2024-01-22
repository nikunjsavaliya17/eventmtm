<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'identifier' => 'privacy_policy',
                'title' => 'Privacy Policy',
                'content' => 'Privacy Policy Content',
            ],
            [
                'identifier' => 'terms',
                'title' => 'Terms & Conditions',
                'content' => 'Terms & Conditions Content',
            ],
        ];
        foreach ($pages as $page){
            $dataExist = Page::where('identifier', $page['identifier'])->first();
            if (is_null($dataExist)){
                Page::create($page);
            }
        }
    }
}
