<?php
/**
 * Profile controller
 *
 * @author Carvelle
 * @version 1.0
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users as UsersModel;

use View;
use Session;


/**
 * Sample controller showing 2 methods and their typical usage.
 */
class Detail extends Controller
{
    protected $theme = 'Bootstrap';
    protected $layout = 'Custom';
    public $detailModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->usersModel = new UsersModel();
    }
    /**
     * Create and return a View instance.
     */
    public function index()
    {
        Session::put('intendedurl', 'getdetail');
        
        if (Session::get('login') == 'true') {
            $url = Session::get('intendedurl');
        } else {
            $url = 'login';
            return Redirect::to('login')->withStatus("Login Required");
        }
        
        $username = $_GET['payee'];
        $userData = $this->usersModel->getUserDetails($username);
		$userInfo = Session::get('userData');
        return View::make('Detail/index')
            ->shares('title', 'Profile')
            ->with('data', $userData)
            ->with('userData', $userInfo[0]);
            
    }

}
