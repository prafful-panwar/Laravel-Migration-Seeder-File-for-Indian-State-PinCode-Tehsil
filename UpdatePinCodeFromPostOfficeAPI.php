<?php

namespace App\Console\Commands;

use App\Models\PinCode;
use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;

class UpdatePinCodeFromPostOfficeAPI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:updateNATalukaName';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Pin Code table where Taluka name are NA';

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
     * @return void
     * @throws GuzzleException
     */
    public function handle()
    {
        $data = PinCode::whereName('NA')->get();
        foreach ($data as $key => $pinCode) {
            $endpoint = "https://api.postalpincode.in/pincode/" . $pinCode->pin_code;
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $endpoint);
            $content = json_decode($response->getBody(), true);
            $postOfficeBlock = 'NA';
            foreach ($content[0]['PostOffice'] as $postOffice) {
                $postOfficeBlock = $postOffice['Block'];
                if ($postOfficeBlock != 'NA') {
                    tap($pinCode)->update([
                        'name' => $postOfficeBlock,
                    ]);
                    break;
                }
            }
            if ($postOfficeBlock == 'NA') {
                tap($pinCode)->update([
                    'name' => $content[0]['PostOffice'][0]['Region']
                ]);
            }
            echo $pinCode->id . "\n";
        }
    }
}
