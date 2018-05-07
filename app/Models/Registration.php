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

class Registration extends BaseModel
{    
   
    public function __construct()
    {
        parent::__construct();
    }
    
    public function registerAccount($data)
    {
        DB::table('accounts')->insert($data);
         
    }
	
	public function updateAccount($data, $where)
    {
        DB::table('accounts')
            ->where('username', $where)
            ->update($data);
    }
	
	public function updateUserPassword($data, $where)
    {
        DB::table('users')
            ->where('username', $where)
            ->update($data);
    }
    
    public function addUser($data)
    {
        DB::table('users')->insert($data);
        
    }
	
	public function checkUser($user){
		
		$data = DB::table('accounts')
			->where('username', $user)
			->get();
		
		return $data;
	}
}