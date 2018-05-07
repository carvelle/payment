<?php

namespace App\Models;
use Nova\Database\Model as BaseModel;
use DB;

class Referrer extends BaseModel
{    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function sumRefAmount()
    {
      
		$data = DB::select("SELECT `id`, `referrer`, `referred`, `refdate`, sum(bonus) as sumbonus, `status` FROM `referrer` WHERE `status` = 1 GROUP BY `referrer`");
    	return $data;
	}
    
	public function addReferrer($data)
    {
        DB::table('referrer')->insert($data);
         
    }
	public function checkReferrer($referrer){
		
		$data = DB::table('accounts')
			->where('username', $referrer)
			->get();
		
		return $data;
	}
	
	public function getReadyReferrers()
	{
		$data = DB::table('referrer')
			->where('status', 1)
			->get();
		return $data;
	}
	
	public function updateRefStatus($data, $referrer, $referred)
    {
        DB::table('referrer')
            ->where('referrer', $referrer)
			->andWhere('referred', $referred)
            ->update($data);
    }
	
	public function getMaxRecipientId()
	{
		$maxId = $price = DB::table('recipient')->max('transactionid');
		return $maxId;
	}

}