<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;

class EmailTemplateDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email_templates = [
            [
                'identifier' => 'reset_password',
                'subject' => 'Reset Your Password',
                'content' => 'Hello #NAME#, <br>Reset URL: #URL#',
            ],
        ];
        foreach ($email_templates as $email_template){
            $dataExist = EmailTemplate::where('identifier', $email_template['identifier'])->first();
            if (is_null($dataExist)){
                EmailTemplate::create($email_template);
            }
        }
    }
}
