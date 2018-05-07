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

class Allocator extends BaseModel
{    
   
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getPayers($data)
    {
        $payer = DB::table('donors')
            ->where('completed', 0)
            ->andWhere('nomoney', 0)
            ->andWhere('payer', '!=', $data)
            ->orderBy('credit', 'desc')
           
            ->get();
        
        return $payer;
        
        
    }
    
    public function getPayee($data)
    {
        $payee = DB::table('donors')
            ->where('completed', 1)
            ->orderBy('credit', 'desc')
            ->groupBy('touched')
            ->get();
        
        return $payee;
        
    }
    
    
    public function playerPaid($data, $where)
    {
        DB::table('donors')
            ->where('id', $where)
            ->update($data);
    }
    
    public function recipientPaid($data, $where)
    {
        DB::table('recipient')
            ->where('transactionid', $where)
            ->update($data);
    }
    
    public function getCommitted($data)
    {
        $committed = DB::table('donors')
            ->where('id', $data)
            ->get();
        
        return $committed;
    }
    
    public function updateCommitted($data, $where)
    {
        DB::table('donors')
            ->where('id', $where)
            ->update($data);
    }
    
    public function addTransaction($data)
    {
        DB::table('transactions')->insert($data);
 
    }
    
    public function playerSaturated($data, $where)
    {
        DB::table('donors')
            ->where('id', $where)
            ->update($data);
    }
    public function updateLasttrans($data, $where)
    {
        DB::table('donors')
            ->where('id', $where)
            ->update($data);
    }
    
    public function updateTouched($data, $where)
    {
        DB::table('donors')
            ->where('id', $where)
            ->update($data);
    }
    
    public function checkRecipient($recipientid)
    {
        
       $exist = DB::table('recipient')
            ->where('transactionid', $recipientid )
            ->get();
        
        return $exist; 
        
    }
    
    public function addRecipient($data)
    {
        DB::table('recipient')->insert($data);
 
    }
    public function updateRecipient($data, $where)
    {
        DB::table('recipient')
            ->where('transactionid', $where)
            ->update($data);
    }
    
    public function moveDonorToRecipient()
    {
        $donors = DB::table('donors')
            ->whereRaw('amount = debit' )
            ->andWhere('completed',1)
            ->andWhere('queued', 0)
            ->andWhere('paid', 0)
            ->get();
        
        return $donors;
    }
    
    public function addToVoided($data)
    {
        DB::table('voided')->insert($data);
 
    }
    
    public function updateTransactionComplete($data, $where)
    {
        DB::table('transactions')
            ->where($where)
            ->update($data);
    }
    public function unpaidTransactions()
    {
         $unpaidTransactions = DB::table('transactions')
            ->where('completed',0)
            ->get();
        
        return $unpaidTransactions;
        
    }
    
    public function updateQueued($data, $where)
    {
        DB::table('donors')
            ->where($where)
            ->update($data);
    }
    
    public function getRecipientByPayee($recipientid, $payee )
    {
        
       $exist = DB::table('recipient')
            ->where('transactionid', $recipientid)
           ->andWhere('payee', $payee)
            ->get();
        return $exist;   
    }
	
	public function getTotalOwed()
    {
       $totalOwed = DB::table('recipient')
            ->where('completed', 0)
            ->get();
        return $totalOwed;   
    }
	
	public function getTotalCommitted()
    {
        $committed = DB::table('transactions')
            ->where('completed', 0)
            ->get();
        
        return $committed;
    }
	
	public function getTotalAvailable()
    {
       $totalAvailable = DB::table('donors')
            ->where('completed', 0)
            ->get();
        return $totalAvailable;   
    }
	
    
    public function updateRecipientForVoided($data, $where)
    {
        DB::table('recipient')
            ->where($where)
            ->update($data);
    }
}