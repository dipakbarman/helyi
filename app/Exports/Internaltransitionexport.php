<?php

namespace App\Exports;

use App\Models\Fundstransferlogmodel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ToModel;
use DB;

class Internaltransitionexport implements FromQuery,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Date',
            'Time',
            'Name',
            'Shop Name',
            'Mobile Number',
            'Action',
            'Amount',
            'Remark',
        ];
    }
    public function query()
    {
        // return product::all();
        // $bulk =  DB::table('product')->select('id', 'name')->where('is_deleted',0)->get();
        // return $bulk;
        //  $bulk = product::query()->select('name','price','quantity','description','category_id','unique_id','stock_available','on_sale','is_deleted','image1','image2','image3','image4','sku','barcode','collection','flash_sale','image5','image6','image7','image8','image9','image10','customsize','cut_price','size_setting','hurryup','percentage','newtag')->where('is_deleted', 0)->get();
        $bulk = Fundstransferlogmodel::query()->select('date','time','viewd_user_name','viewd_user_shop_name','viewd_user_shop_phone','action_name','amount','remark')->where('userid',session()->get('userid'))->orderby('id','DESC');
         return $bulk;
    }
    public function map($bulk): array
    {
        return [
            $bulk->date,
            $bulk->time,
            $bulk->viewd_user_name,
            $bulk->viewd_user_shop_name,
            $bulk->viewd_user_shop_phone,
            $bulk->action_name,
            $bulk->amount,
            $bulk->remark,
        ];
    }
}
