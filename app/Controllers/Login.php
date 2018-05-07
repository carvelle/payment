<?php
/**
 * Login controller
 *
 * @author Carvelle
 * @version 1.0
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Users as UsersModel;
use App;
use Auth;
use Hash;
use Input;
use Password;
use Redirect;
use Response;
use Session;

use View;


/**
 * Sample controller showing 2 methods and their typical usage.
 */
class Login extends Controller
{

    protected $theme = 'Bootstrap';
    protected $layout = 'Custom';
    public $usersModel;
    
    
    public function __construct()
    {
        parent::__construct();
        $this->usersModel = new UsersModel();
    }
    public function index()
    {
        //return $this->getView()->shares('title', 'Login');
		
		return View::make('Login/index')
                ->shares('title', 'Login')
                ->with('error', (Session::get('error')));
    }
	
	public function adminLoginView()
    {
        //return $this->getView()->shares('title', 'Login');
		
		return View::make('Login/adminLogin')
                ->shares('title', 'Login')
                ->with('error', (Session::get('error')));
    }

    public function postLogin()
    {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
		
		if($username[0]=== '0'){
			$tmp = ltrim($username, '0');
			$username = "27$tmp";
		}

        if(! Auth::attempt(array('username' => $username, 'password' => $password))) {
            $status = __d('users', 'Wrong username or password.');
            Session::put('error', 'Incorrect password');
			return Redirect::back()->withStatus($status, 'danger');
        }
        

        $user = Auth::user();


        $userData = $this->usersModel->getUserDetails($username);
		
		if($userData[0]->usergroup == 0){
			$status = __d('users', 'Please activate your account');
			Session::put('error', 'Your account is not activated yet. Please pay your initial investment to activate your account, else contact the admin.');
            return Redirect::back()->withStatus($status, 'danger');
		}
        Session::put('login', 'true');
        Session::put('username', $username);
        Session::put('userData', $userData);
        if(Session::has('intendedurl')){
           return Redirect::to(Session::get('intendedurl')); 
        }

        $status = __d('users', '<b>{0}</b>, you have successfully logged in.', $user->username);
        return Redirect::to('dashboard')->withStatus("success");
    }
	
	 public function adminLogin()
    {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
		$userInfo = Session::get('userData');
		$isAdmin = (Session::get('login') && ($userInfo[0]->usergroup == 42));
		$codedPass = strtolower("9CBABA89F22D0B0F55522F699E5CA693794B614E390AF25DEB493D676F611663");
		$hashpassword = hash('sha256', $password, false);
		

        if(! $isAdmin) {
            $status = __d('users', 'Wrong username or password.');
            Session::put('error', 'You dont have admin rights');
			return Redirect::back()->withStatus($status, 'danger');
        }
		if($codedPass != $hashpassword) {
            $status = __d('users', 'Wrong username or password.');
            Session::put('error', 'Incorrect password');
			return Redirect::back()->withStatus($status, 'danger');
        }
        
        $user = $username;
        $userData = $this->usersModel->getUserDetails($username);
		if(count($userData)> 0 ){
			Session::put('login', 'true');
			Session::put('username', $username);
			Session::put('userData', $userData);
			if(Session::has('intendedurl')){
			   return Redirect::to(Session::get('intendedurl')); 
			}

			$status = __d('users', '<b>{0}</b>, you have successfully logged in.', $user->username);
			return Redirect::to('dashboard')->withStatus("success");
		}
		else{
            $status = __d('users', 'Wrong username or password.');
            Session::put('error', 'No Such user');
			return Redirect::back()->withStatus($status, 'danger');
        }
        
    }
    
    public function logout()
    {
        
        Session::flush();

        // Prepare the flash message.
        $status = __d('system', 'You have successfully logged out.');

        return Redirect::to('login')->withStatus($status);
        
        
    }
}
