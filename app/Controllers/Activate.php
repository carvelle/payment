<?php
/**
 * Profile controller
 *
 * @author Carvelle
 * @version 1.0
 */

namespace App\Controllers;

use App\Core\Controller;
use View;
use Session;
use Redirect;
use App\Models\ActivateUsers as ActivateModel;


/**
 * Sample controller showing 2 methods and their typical usage.
 */
class Activate extends Controller
{
    protected $theme = 'Bootstrap';
    protected $layout = 'Datatables';
    public $activateModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->activateModel = new ActivateModel();
        
    }
    
    public function index()
    {
         Session::put('intendedurl', 'userpay');
        
        if (Session::get('login') == 'true') {
            $url = Session::get('intendedurl');
        } else {
            $url = 'login';
            return Redirect::to('login')->withStatus("Login Required");
        }
		$userData = Session::get('userData');
        
        return View::make('Activate/index')
                ->shares('title', 'Activate user')
                ->with('welcomeMessage', 'some message')
                ->with('userData', $userData[0]);
        
    }
	
	public function Activate(){
		
		$data = array('usergroup' => 1);
		$where = array('username' =>trim($_POST['username']));
		$this->activateModel->activateUsers($data, $where);
		$this->activateModel->activateAccounts($data, $where);
	}

}
