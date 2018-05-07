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

class Approve extends BaseModel
{    
   
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getPayeeForTable($data)
    {
       $data =  DB::table('transactions')
                ->where('payer', $data)
                ->andWhere('completed','<=', 1)
                ->join('accounts', 'transactions.payee', '=', 'accounts.username')
                ->select('transactions.recipientid','accounts.name', 'accounts.surname','transactions.completed', 'transactions.payee', 'transactions.paymentdate', 'transactions.amount')
                ->get();
        
        return $data;
    }
    
    public function getPayerForTable($data)
    {
       $data =  DB::table('transactions')
                ->where('payee', $data)
                ->andWhere('completed','<=', 1)
                ->join('accounts', 'transactions.payer', '=', 'accounts.username')
                ->select('transactions.recipientid','accounts.name', 'accounts.surname','transactions.completed', 'transactions.payer', 'transactions.payee', 'transactions.paymentdate', 'transactions.amount')
                ->get();
        
        return $data;
    }
    
}