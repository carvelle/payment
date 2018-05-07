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
use Redirect;


/**
 * Sample controller showing 2 methods and their typical usage.
 */
class Profile extends Controller
{
    protected $theme = 'Bootstrap';
    protected $layout = 'Custom';
    public $userModel;
    
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
        Session::put('intendedurl', 'profile');
        
        if (Session::get('login') == 'true') {
            $url = Session::get('intendedurl');
        } else {
            $url = 'login';
            return Redirect::to('login')->withStatus("Login Required");
        }
        
        $userData = $this->usersModel->getUserDetails(Session::get('username'));
		$userInfo = Session::get('userData');
        return View::make('Profile/index')
                    ->shares('title', 'Profile')
                    ->with('data', $userData)
                    ->with('userData', $userInfo[0]);
        
    }


}
