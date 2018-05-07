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

class Dashboard extends BaseModel
{    
   
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getPayeeForTable($data)
    {
       $data =  DB::table('transactions')
                ->where('payer', $data)
                ->andWhere('completed', 0)
                ->join('accounts', 'transactions.payee', '=', 'accounts.username')
                ->select('transactions.recipientid','accounts.name', 'accounts.surname', 'transactions.payee', 'transactions.paymentdate', 'transactions.amount')
                ->get();
        
        return $data;
    }
    
    public function getPayerForTable($data)
    {
       $data =  DB::table('transactions')
                ->where('payee', $data)
                ->andWhere('completed', 0)
                ->join('accounts', 'transactions.payer', '=', 'accounts.username')
                ->select('transactions.recipientid','accounts.name', 'accounts.surname', 'transactions.payee', 'transactions.paymentdate', 'transactions.amount')
                ->get();
        
        return $data;
    }
    
    public function getDuePayments($data)
    {
       $data =  DB::table('transactions')
                ->where('payee', $data)
                ->andWhere('completed', 0)
                ->join('accounts', 'transactions.payee', '=', 'accounts.username')
                ->select('transactions.amount')
                ->get();
        
        return $data;
    }
    
    public function getInvestmentProgress($data)
    {
       $data =  DB::table('accounts')
                ->where('username', $data)
                ->select('amount', 'createddate', 'group')
                ->get();
        
        return $data;
    }
    
    public function getPaymentProgress($data, $id)
    {
       $data =  DB::table('successful')
                ->where('_payee', $data)
                ->andWhere('transactionid', $id )
                ->get();
        
        return $data;
    }
    
    
    public function getLastTransactionid($payee)
    {
        
         $id =  DB::table('recipient')
                ->where('payee', $payee)
                ->orderBy('transactionid', 'desc')
                ->take(1)
                ->get();
        
        return $id;
        
    }
    
    
    

}