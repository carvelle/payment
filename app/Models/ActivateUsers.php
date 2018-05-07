<?php


namespace App\Models;
use Nova\Database\Model as BaseModel;
use DB;

class ActivateUsers extends BaseModel
{    
   
    public function __construct()
    {
        parent::__construct();
    }
    
    public function activateAccounts($data, $where)
    {
        DB::table('accounts')
            ->where($where)
            ->update($data);
    }
    
    public function activateUsers($data, $where)
    {
        DB::table('users')
            ->where($where)
            ->update($data);
    }
    
}