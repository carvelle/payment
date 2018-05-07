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

class Play extends BaseModel
{    
   public $classvar;
    public function __construct()
    {
        parent::__construct();
        $classvar ='This is a class var';
    }
    
    public function addPlayer($data)
    {
        $id = DB::table('donors')->insertGetId($data);
		return $id;
    }
    
	public function getRecipients($recipient)
    {
         $incompleteRecipients = DB::table('recipient')
            ->where('payee',$recipient)
			->andWhere('completed', 0)
            ->get();
        return $incompleteRecipients;  
    }
	
	public function getNonPayers($payer)
    {
         $nonPayers = DB::table('voided')
            ->where('_payer',$payer)
            ->get();
        return $nonPayers;  
    }

}