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

class Users extends BaseModel
{    
   
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getUserDetails($data)
    {
       $userData = DB::table('accounts')
            ->where('username', $data)
            ->get();
        
        return $userData; 
        
    }
    

}