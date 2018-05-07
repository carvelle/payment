<?php
/**
 * Registration controller
 *
 * @author Carvelle
 * @version 1.0
 */

namespace App\Controllers;

use App\Core\Controller;

use View;
use Hash;
use Session;
use App\Models\Registration as RegistrationModel;
use App\Models\Referrer as ReferrerModel;
use App\Controllers\Communicate as Communicate;

class Registration extends Controller
{
    public $registerModel;
	public $referrerModel;
    protected $theme = 'Bootstrap';
    protected $layout = 'Custom';
	public $communicate;
    
    public function __construct()
    {
        parent::__construct();
        $this->registerModel = new RegistrationModel();
		$this->referrerModel = new ReferrerModel();
		$this->communicate = new Communicate();
    }

    /**
     * Create and return a View instance.
     */
    public function index()
    {
       
        return $this->getView()->shares('title', 'Registration');
    }

    public function addNewUser()
    {
		$user = $_POST['cellular'];
		$user = str_replace(' ','',$user);
		
		if($user[0] ==='0'){
			$user = ltrim($user, "0");
			$user = '27'.$user;
		}
		
		$passwordhash = Hash::make(trim($_POST['password']));
		$regData = array( 
				'name' => trim(ucfirst(strtolower($_POST['name']))),
				'surname' => trim(ucfirst(strtolower($_POST['surname']))),
				'username' => trim($user),
				'cellphone' => trim(ucfirst($user)),
				'email' =>trim($_POST['email']),
				'idnumber' =>trim(ucfirst($_POST['identification'])),
				'bankname' =>trim(ucfirst($_POST['bankname'])),
				'bankaccholder' => trim(ucfirst($_POST['holder'])),
				'bankacc' => trim(ucfirst($_POST['accno'])),
				'bankbranch' => trim(ucfirst($_POST['branch'])),
                'createddate' => date('Y-m-d H:i:s'),
                'group' => trim($_POST['group']),
				'usergroup' =>0,
                'amount' =>trim($_POST['payment'])
			);
        
        $userData = array( 
				'username' => trim($user),
				'password' => $passwordhash,
				'usergroup' =>0,
			);
		$usercount = $this->registerModel->checkUser($user);
		
		if(count($usercount) == 0){
			$this->communicate->joinEmail($regData['email'], $regData['name'],$regData['surname'], $regData['amount'], $regData['cellphone']);
			$this->communicate->joinSMS($regData['amount'], $regData['name'], $regData['cellphone']);
			echo " User was registered. Please pay your initial Investment to activate your account. Details sent via email and sms ";
		}
		else if(count($usercount) > 0){
			echo " This user already exist. Please request password reset from admin@africanvalues.org ";
			return;
		}
		
		if(isset($_POST['refcheck'])){
			if(isset($_POST['reftext'])){
        		$referrer = trim(ucfirst($_POST['reftext']));
				$referred = trim(ucfirst($user));
				$amount = (int)((float)(trim(ucfirst($_POST['payment']))) * 0.1);
				$this->addReferrer($referrer, $referred, $amount);
			}
		}
  
        $this->registerModel->registerAccount($regData);
		$this->registerModel->addUser($userData);
    }
	
	public function updateUser()
    {
       
        $updateData = array( 
				'name' => trim(ucfirst(strtolower($_POST['name']))),
				'surname' => trim(ucfirst(strtolower($_POST['surname']))),
				'email' =>trim($_POST['email']),
				'idnumber' =>trim(ucfirst($_POST['identification'])),
				'bankname' =>trim(ucfirst($_POST['bankname'])),
				'bankaccholder' => trim(ucfirst($_POST['holder'])),
				'bankacc' => trim(ucfirst($_POST['accno'])),
				'bankbranch' => trim(ucfirst($_POST['branch'])),
                'updateddate' => date('Y-m-d H:i:s'),

			);
        
        $this->registerModel->updateAccount($updateData,Session::get('username'));
    }
	
	public function changePassword()
    {
        $passwordhash = Hash::make(trim($_POST['password']));
        $userData = array( 
				'password' => $passwordhash,
			);
        
		$this->registerModel->updateUserPassword($userData, Session::get('username'));
    }
	
	public function addReferrer($referrer, $referred, $amount){
		
		$refdata = array('referrer' => $referrer,
						 'referred' => $referred,
						 'refdate' => date('Y-m-d H:i:s'),
						 'bonus' => $amount,
						 'status' => 0
					);
		
		$this->referrerModel->addReferrer($refdata);
	}
	
	public function checkReferrerExist(){
		
		$referrer = $_POST['reftext'];
		if($referrer[0]=== '0'){
			$tmp = ltrim($referrer, '0');
			$referrer = "27$tmp";
		}
		$refcount = $this->referrerModel->checkReferrer($referrer);
		
		if(count($refcount) == 0){
			
			echo " No such account exist. Please ensure that your referrer is registered as a user on our system";
		}
		else if(count($refcount) > 0){
			
		}
	}


}
