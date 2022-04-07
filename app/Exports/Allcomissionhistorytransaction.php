<?php

namespace App\Exports;

use App\Models\DistributelogModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ToModel;
use DB;

class Allcomissionhistorytransaction implements FromQuery,WithHeadings
{
     /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Date',
            'User Name',
            'Mobile Number',
            'Commission',
        ];
    }
    public function query()
    {
        if(session()->get('type') == 3){
            $bulk = DistributelogModel::query()->select('getdate','user_name','user_phone','distributor')->where('dis_id',session()->get('userid'))->orderBy('id','DESC');
        }
        if(session()->get('type') == 4){
            $bulk = DistributelogModel::query()->select('getdate','user_name','user_phone','master_distributor')->where('md_id',session()->get('userid'))->where('master_distributor','!=',NULL)->orderBy('id','DESC');
        }
         return $bulk;
    }
    public function map($bulk): array
    {
        return [
            $bulk->getdate,
            $bulk->user_name,
            $bulk->user_phone,
            $bulk->distributor,
            $bulk->master_distributor,
        ];
    }
}
