<?php
/**
 * Users - A Users Model.
 *
 * @author Virgil-Adrian Teaca - virgil@giulianaeassociati.com
 * @version 3.0
 */

namespace App\Models;
use Nova\Database\Model as BaseModel;
use DB;

class Pay extends BaseModel
{    
   
    public function __construct()
    {
        parent::__construct();
    }
    
    public function iPaid($data, $where)
    {
        DB::table('transactions')
            ->where($where)
            ->update($data);
    }
    
    public function confirm($data, $where)
    {
        DB::table('transactions')
            ->where($where)
            ->update($data);
    }
    
    public function getTransactionToMove($where, $payer)
    {
        $transaction = DB::table('transactions')
            ->where('completed',2)
            ->andWhere('recipientid', $where)
            ->andWhere('payer', $payer)
            ->get();
        
        return $transaction;
    }
	
	public function updateBanned($data, $payer, $payee, $id)
    {
			DB::table('voided')
            ->where('_payer', $payer)
            ->andWhere('_payee', $payee)
			->andWhere('transactionid', $id)
            ->update($data);
    }
    
    public function moveTransactionToSuccessful($data)
    {
        DB::table('successful')->insert($data);
    }
    
    public function getDebit($payerid)
    {
        $donor = DB::table('donors')
                ->where('id', $payerid)
                ->get();
            
            return $donor;
        
    }
    
    public function updateDebit($data, $where)    
    {
         DB::table('donors')
            ->where('id', $where)
            ->update($data); 
    }
}