<?php
/**
 * Profile controller
 *
 * @author Carvelle
 * @version 1.0
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Allocator as AllocationModel;
use App\Helpers\ssp as SSP;

use View;
use Session;
use Redirect;


/**
 * Sample controller showing 2 methods and their typical usage.
 */
class Datatables extends Controller
{
    protected $theme = 'Bootstrap';
    protected $layout = 'Datatables';
    public $allocationModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->allocationModel = new AllocationModel();
    }
    
    public function payUser()
    {
        Session::put('intendedurl', 'payuser');
        
        if (Session::get('login') == 'true') {
            $url = Session::get('intendedurl');
        } else {
            $url = 'login';
            return Redirect::to('login')->withStatus("message");
        }
        // DB table to use
        $table = 'recipient';
        $join = 'accounts';
        $columnA = 'recipient.payee';
        $columnB = 'accounts.username';
        
        $whereColumn = 'completed';
        $whereValue = 0;

        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case object
        // parameter names
        $columns = array(
            array( 'db' => 'transactionid',   'dt' => 'id' ),
            array( 'db' => 'name',   'dt' => 'name' ),
            array( 'db' => 'surname',     'dt' => 'surname'),
            array( 'db' => 'username',   'dt' => 'username' ),
            array( 'db' => 'lasttrans',     'dt' => 'lasttrans' ),
            array( 'db' => 'email',     'dt' => 'email' ),
            array( 'db' => 'idnumber',     'dt' => 'idnumber' ),
            array( 'db' => 'initamount',     'dt' => 'credit' ),
			array( 'db' => 'initinvest',     'dt' => 'initinvest' ),
			array( 'db' => 'reforinv',     'dt' => 'reforinv' ),
            array( 'db' => 'committed',     'dt' => 'committed' ),
            
            
        );

        // SQL server connection information
        $sql_details = array(
            'user' => 'africbaa_sibu',
            'pass' => 'TUESday1#',
            'db'   => 'africbaa_africanvalues',
            'host' => 'localhost'
        );


        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.
         */

        //require( 'ssp.class.php' );

        echo json_encode(
            //SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns )
            SSP::joinquery( $_POST, $sql_details, $table, $join, $primaryKey, $columns, $columnA, $columnB, $whereColumn, $whereValue)
        );
    }
	
	public function voidedTrans()
    {

        $table = 'voided';


        // Table's primary key
        $primaryKey = 'id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case object
        // parameter names
        $columns = array(
            array( 'db' => 'id',   'dt' => 'id' ),
            array( 'db' => '_payee',   'dt' => 'payee' ),
            array( 'db' => '_payer',     'dt' => 'payer'),
            array( 'db' => 'unpaidamount',   'dt' => 'amount' ),
            array( 'db' => 'lasttrans',     'dt' => 'lasttrans' ),
            array( 'db' => 'transactionid',     'dt' => 'transid' ),
			array( 'db' => 'status',     'dt' => 'status' ),
  
        );

        // SQL server connection information
        $sql_details = array(
            'user' => 'africbaa_sibu',
            'pass' => 'TUESday1#',
            'db'   => 'africbaa_africanvalues',
            'host' => 'localhost'
        );


        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.
         */

        //require( 'ssp.class.php' );

        echo json_encode(
            SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns )
        );
    }
	
	public function activateUser()
    {
        Session::put('intendedurl', 'payuser');
        
        if (Session::get('login') == 'true') {
            $url = Session::get('intendedurl');
        } else {
            $url = 'login';
            return Redirect::to('login')->withStatus("message");
        }
        // DB table to use
        $table = 'accounts';

 
        // Table's primary key
        $primaryKey = '_id';

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case object
        // parameter names
        $columns = array(
            array( 'db' => '_id',   'dt' => 'id' ),
            array( 'db' => 'name',   'dt' => 'name' ),
            array( 'db' => 'surname',     'dt' => 'surname'),
            array( 'db' => 'username',   'dt' => 'username' ),
            array( 'db' => 'createddate',     'dt' => 'createddate' ),
            array( 'db' => 'email',     'dt' => 'email' ),
            array( 'db' => 'idnumber',     'dt' => 'idnumber' ),
            array( 'db' => 'amount',     'dt' => 'amount' ),
			array( 'db' => 'usergroup',     'dt' => 'usergroup' ),
            
        );

        // SQL server connection information
        $sql_details = array(
            'user' => 'africbaa_sibu',
            'pass' => 'TUESday1#',
            'db'   => 'africbaa_africanvalues',
            'host' => 'localhost'
        );


        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP
         * server-side, there is no need to edit below this line.
         */

        //require( 'ssp.class.php' );

        echo json_encode(
            SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns )
            //SSP::query( $_POST, $sql_details, $table, $join, $primaryKey, $columns, $columnA, $columnB, $whereColumn, $whereValue)
        );
    }
	
	

}
