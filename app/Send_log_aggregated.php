<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Send_log_aggregated extends Model
{
    public static function getInfo($from,$to,$usr_id=0,$cnt_id=0)
    {
        $query = self::select('date_at', DB::raw('SUM(count_success) as success'),DB::raw('SUM(count_failed) as failed'))
                ->whereBetween('date_at', [$from, $to]);
        if($usr_id){
            $query->where('usr_id', $usr_id);
        }
        if($cnt_id){
            $query->where('cnt_id', $cnt_id);
        }
        $query->groupBy('date_at');
        $data = $query->get();

        return $data;
    }
}
