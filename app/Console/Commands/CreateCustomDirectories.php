<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CreateCustomDirectories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:uploadable_directories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will create the directories needed in the application and also create the symbolic link between storage and public/storage directory';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        # CREATE FOLDER PUBLIC

            $directories = [
                'app/public/sponsor' => 'sponsor',
                'app/public/food_partner' => 'food_partner',
                'app/public/food_menu' => 'food_menu',
                'app/public/event' => 'event',
            ];
        foreach ($directories as $key => $path) {
            if (!File::isDirectory(storage_path($key))) {
                Storage::disk('public')->makeDirectory($path);
            }
        }
    }
}
