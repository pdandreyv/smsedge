<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Country;
use App\Number;
use App\Send_log;

class generateUserData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:user_data {count=10}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate by default 10 random users data';

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
        $users = User::all()->pluck('usr_id');
        $numbers = Number::all()->pluck('num_id');
        $log_messages = [
            'Failed transaction',
            'Good transaction'
        ];
        $data = [];
        for($i=0;$i<$count;$i++){
            $bool = ceil(rand(0,10)/10); // 10% failed queries
            $data[] = [
                'usr_id' => $users[rand(0,(count($users)-1))],
                'num_id' => $numbers[rand(0,(count($numbers)-1))],
                'log_message' => $log_messages[$bool],
                'log_success' => $bool,
                'created_at' => date('Y-m-d',strtotime("-".rand(0,5)." days"))
            ];
        }
        Send_log::insert($data);
        echo $count." random user send data was generated successfull!";
    }
}
