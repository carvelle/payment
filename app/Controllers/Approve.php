<?php
/**
 * Dashboard controller
 *
 * @author Carvelle
 * @version 1.0
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Approve as ApproveModel;

use View;
use Session;
use Redirect;


/**
 * Sample controller showing 2 methods and their typical usage.
 */
class Approve extends Controller
{

    protected $theme = 'Bootstrap';
    protected $layout = 'Custom';
    public $approveModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->approveModel = new ApproveModel();
    }
    /**
     * Create and return a View instance.
     */
    public function index()
    {
        Session::put('intendedurl', 'approve');
        
        if (Session::get('login') == 'true') {
            $url = Session::get('intendedurl');
        } else {
            $url = 'login';
            return Redirect::to('login')->withStatus("message");
        }
       
		$userData = Session::get('userData');
        $payees = $this->getPayeeForTable();
        $payers = $this->getPayerForTable();
        return View::make('Approve/index')
                    ->shares('title', 'Approve')
                    ->with('payees', $payees)
                    ->with('payers', $payers)
                    ->with('userData', $userData[0]);
    }
    
    public function getPayeeForTable()
    {
        
        $username = Session::get('username');
        $payees = $this->approveModel->getPayeeForTable($username);
        
        return $payees;
    }
    
     public function getPayerForTable()
    {
        
        $username = Session::get('username');
        $payers = $this->approveModel->getPayerForTable($username);
        
        return $payers;
    }
    
    public function redirectToLogin($redirectUrl)
    {
        Session::put('intendedurl', $redirectUrl);
        if (Session::get('login') == 'true') {
            $url = Session::get('intendedurl');
            echo "boooidsofiodids";
        } else {
            $url = 'login';
            return Redirect::to('login')->withStatus("message");
            //echo $url;
        }

            // Redirect to url
        //return Redirect::to($url);
        $status = __d('system', 'You have successfully logged out.');

        return Redirect::to('login')->withStatus($status);
        
    }
    
}
