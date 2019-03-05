<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Country;
use App\Number;

class generateNumbersData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:number_data {count=10}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate by default 10 random numbers data';

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
        $count = $this->argument('count');
        $countries = Country::all()->pluck('cnt_id');
        $data = [];
        for($i=0;$i<$count;$i++){
            $data[] = [
                'cnt_id' => $countries[rand(0,(count($countries)-1))],
                'num_number' => rand(100,10000)
            ];
        }
        Number::insert($data);
        echo $count." random numbers data was generated successfull!";
    }
}
