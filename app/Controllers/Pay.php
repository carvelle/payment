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
use App\Models\Pay as PayModel;
use App\Models\Users as UsersModel;
use App\Controllers\Communicate as Communicate;



/**
 * Sample controller showing 2 methods and their typical usage.
 */
class Pay extends Controller
{
    protected $theme = 'Bootstrap';
    protected $layout = 'Datatables';
    public $payModel;
	public $usersModel;
	public $communicate;
    
    public function __construct()
    {
        parent::__construct();
        $this->payModel = new PayModel();
		$this->usersModel = new UsersModel();
		$this->communicate = new Communicate();
        
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
        
        return View::make('Pay/index')
                ->shares('title', 'Pay')
                ->with('welcomeMessage', 'some message')
                ->with('userData', $userData[0]);
        
    }
    
    public function iPaid()
    {
        $transactionid = $_POST['transactionid'];
        $payee = $_POST['payee'];
        $payer = Session::get('username');
        
        $data = array('completed' => 1);
        $where = array('payee' => $payee,
                       'payer' => $payer,
                      'recipientid' => $transactionid);
        
        $this->payModel->iPaid($data, $where);
		$payerInfo = Session::get('userData');
		$payeeInfo = $this->usersModel->getUserDetails($payee);
		
		$this->communicate->verifySMS($payeeInfo[0]->name, $payeeInfo[0]->cellphone,$payerInfo[0]->name, $_POST['amount']) ;
		$this->communicate->verifyEmail($payeeInfo[0]->name, $payeeInfo[0]->email,$payerInfo[0]->name, $_POST['amount']);
        
    }
	
	public function removeVoided(){
		
		$transactionid = $_POST['transactionid'];
        $payee = $_POST['payee'];
		$payer = $_POST['payer'];
		$status = $_POST['status'];
		
		if($status === '0'){
			$data = array('status' => 1);
			echo "$payer is no longer Banned";
			$this->payModel->updateBanned($data, $payer, $payee, $transactionid);
		}
	}
    
    public function confirm()
    {
        $transactionid = $_POST['transactionid'];
        $payer = $_POST['payer'];
        
        $data = array('completed' => 2);
        
        $where = array('payer' => $payer,
                      'recipientid' => $transactionid);
        
        
        $this->payModel->confirm($data, $where);
        
        $transToMove = $this->payModel->getTransactionToMove($transactionid, $payer);
        
        $payerid = $transToMove[0]->payerid;
        
        $donor = $this->getDonor($payerid);
        $debit = $donor[0]->debit;
        $amountToDebit = $transToMove[0]->amount;
        $newDebit = $debit + $amountToDebit;
        
        $this->updateDebit($payerid, $newDebit);
        
        $dataSucc = array('_payer' => $transToMove[0]->payer,
                     '_payee' => $transToMove[0]->payee,
                     'lasttrans'=> $transToMove[0]->paymentdate,
                     'transactionid' => $transToMove[0]->recipientid,
                     'paidamount' =>$transToMove[0]->amount
                     );
        $this->payModel->moveTransactionToSuccessful($dataSucc);
           
    }
    
    public function getDonor($payerid)
    {
        $donor = $this->payModel->getDebit($payerid);
        $debit = $donor[0]->debit;
        
        return $donor;
        
    }
    
    public function updateDebit($payerid, $newDebit)
    {
        $debitData = array('debit' => $newDebit);
        
        $this->payModel->updateDebit($debitData, $payerid);
        
    }
    
    

}
