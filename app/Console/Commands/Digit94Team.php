<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Setting;
use Storage;
use Illuminate\Support\Str;
use GuzzleHttp\Client;

class Digit94Team extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'digit94team:validator {purchase_code}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Digit94Team Validator';

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
     * @return int
     */
    public function handle()
    {
        try {
            $filePath = base64_decode('YWN0aXZhdGVk');
    
            // Check if the file exists
            if (file_exists(storage_path($filePath))) {

                $purchase_code = $this->argument('purchase_code');
                Setting::update_option('purchase_code', $purchase_code);

                // Read the contents of the file
                $fileContents = trim(file_get_contents(storage_path($filePath)));

                $itemId = '28707541';
                $uri = base64_decode('aHR0cHM6Ly9saWNlbnNlLW1hbmFnZXIuZGlnaXQ5NHRlYW0uY29tL2FwaS9jaGVja2Vy');

                $client = new Client();

                $response = $client->get($uri, [
                    'query' => [
                        'purchase_code' => get_option('purchase_code'),
                        'item_id' => $itemId,
                        'domain' => url()->full(),
                    ],
                ]);

                $body = $response->getBody();

                $data = json_decode($body, true);

                if(isset($data) && $data['status'] == 1){

                    // update_option('current_version', env('current_version'));
                    // setEnv('current_version', $data['current_version']);

                    update_option('available_version', $data['available_version']);
                    setEnv('available_version', $data['available_version']);

                    update_option('supported_until', $data['supported_until']);
                    setEnv('supported_until', $data['supported_until']);

                    update_option('supported_status', $data['supported_status']);
                    setEnv('supported_status', $data['supported_status']);

                    update_option('last_check', now());
                    setEnv('last_check', now());

                    update_option('license_message', $data['message']);
                
                }

                return "Done";

            } else {
                update_option('purchase_code', '');

                update_option('available_version', '');
                setEnv('available_version', '');

                    update_option('supported_until', '');
                    setEnv('supported_until', '');

                    update_option('supported_status', '');
                    setEnv('supported_status', '');

                   // update_option('last_check', now());
                   // setEnv('last_check', now());

                    update_option('license_message', '');
                return "The file does not exist.";
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }
}
