<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Send_log;
use App\Send_log_aggregated;

class aggregateLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aggregate:send_log';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aggregating send log table';

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
        $sql = 'SELECT s.usr_id,c.cnt_id,s.created_at,s.log_success,count(log_success) coun_res FROM `send_logs` s
                LEFT JOIN numbers n ON n.num_id = s.num_id
                LEFT JOIN countries c ON c.cnt_id = n.cnt_id
                GROUP BY created_at,usr_id,cnt_id,log_success';
        
        $data = DB::select($sql);
        $data_count = Send_log::count();
        if($data_count){
            Send_log::query()->truncate();
            $res = [];
            foreach($data as $v){
                if(!isset($res[$v->created_at][$v->usr_id][$v->cnt_id])){
                    $res[$v->created_at][$v->usr_id][$v->cnt_id]['count_success'] = 0;
                    $res[$v->created_at][$v->usr_id][$v->cnt_id]['count_failed'] = 0;
                }
                if($v->log_success==1)
                    $res[$v->created_at][$v->usr_id][$v->cnt_id]['count_success'] = $v->coun_res;
                if($v->log_success==0)
                    $res[$v->created_at][$v->usr_id][$v->cnt_id]['count_failed'] = $v->coun_res;
            }
            unset($data);
            $aggr = [];
            foreach($res as $date_at => $d){
                foreach($d as $usr_id => $u){
                    foreach($u as $cnt_id => $c){
                        $aggr[] = [
                            'date_at' => $date_at,
                            'usr_id' => $usr_id,
                            'cnt_id' => $cnt_id,
                            'count_success' => $c['count_success'],
                            'count_failed' => $c['count_failed']
                        ];
                    }
                }
            }
            Send_log_aggregated::insert($aggr);
            echo "Log data was aggregated successfull!\n"
            . "Was inserted is ".count($aggr)." rows in to send_log_aggregateds table\n"
            . "And delete ".$data_count." rows from Send_logs table";
        } else {
            echo "Table 'send_logs' is empty";
        }
    }
}
