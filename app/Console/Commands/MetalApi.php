<?php

namespace App\Console\Commands;

use App\Models\Configuration;
use Exception;
use Illuminate\Console\Command;

class MetalApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MetalApi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $metalsUrl = "https://www.metals-api.com/api/latest?access_key=j4cr6xsfm4v2maz5hp47hlew1fb19a8pgtpjxgb1b6t5x2l9ag7xsvg4c42h&base=INR&symbols=XAU%2CXAG%2CXPD%2CXPT%2CXRH";
        try{
			$list = file_get_contents($metalsUrl);
		}catch(Exception $e){
			$list=null;
		}
        if($list){
          Configuration::updateOrCreate(['key'=>'metal-api'],[
            'value'=>$list,'key'=>'metal-api'
          ]);
        }
        return 0;
    }
}
