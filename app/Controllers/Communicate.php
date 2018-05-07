<?php
/**
 * Communicate controller
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
use Mailer;

class Communicate extends Controller
{

    protected $theme = 'Bootstrap';
    protected $layout = 'custom';
    public $approveModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->approveModel = new ApproveModel();
    }
    /**
     * Create and return a View instance.
     */
    public function sendMessages()
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
    
    
   public function sendEmail($email, $name, $surname, $number)
    {
        
        Mailer::send('Emails/Welcome', ['title' => 'demo', 'content' => 'ok'], function($message)
        {
            $message->to($email, $name)->subject('Welcome!');
            $message->from('accounts@africanvaluesnetwork.org', 'African Values Network');
        });
        
    }
    
    public function joinSMS($investment, $name, $number)
    {
		$text = urlencode("Welcome to AFN $name. To activate your account, pay your initial investment of R$investment \nTo:\nInstitution: First National Bank\nAcc Holder: African Values Network\nAcc No. 6275 9831 011\nBranch Code: 759\nReference: $number \n\n-African Values");
		$user = "NuronTech";
		$password = "aSQPVPNZSNcfab";
		$api_id = "3486980";
		$baseurl ="http://api.clickatell.com";
		$to = $number;
		$url = "$baseurl/http/sendmsg?user=$user&password=$password&api_id=$api_id&to=$to&text=$text";	
		//http://api.clickatell.com/http/sendmsg?user=NuronTech&password=aSQPVPNZSNcfab&api_id=3486980&to=27662150052&text=Message2
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curl);
		curl_close($curl);
		$ret = $result;
         
    }
	
	public function joinEmail($email, $name, $surname, $investment, $number)
    {
        $content = "Welcome to AFN. To activate your account, pay your initial investment of R$investment <br/>To:<br/>Institution: First National Bank<br/>Acc Holder: African Values Network<br/>Acc No. 6275 9831 011 <br/>Branch Code: 759<br/>Reference: $number <br/>";
        Mailer::send('Emails/Welcome', ['title' => $name, 'content' => $content], function($message) use($email, $name, $surname)
        {
            $message->to($email, $name)->subject('Welcome to African Values Network');
            $message->from('accounts@africanvaluesnetwork.org', 'African Values Network');
        });
        
    }
	
	public function playSMS($playingFee, $number, $trans)
    {
		$text = urlencode("Thank you for your support. Please pay admin fee of  R$playingFee(10% of your contribution)\nTo:\nInstitution: First National Bank\nAcc Holder: African Values Network\nAcc No. 6275 9831 011\nBranch Code: 759 \nReference: $trans\n\n-African Values");
		$user = "NuronTech";
		$password = "aSQPVPNZSNcfab";
		$api_id = "3486980";
		$baseurl ="http://api.clickatell.com";
		$to = $number;
		$url = "$baseurl/http/sendmsg?user=$user&password=$password&api_id=$api_id&to=$to&text=$text";
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curl);
		curl_close($curl);
		$ret = $result;
        
        
    }
	
	public function playEmail($email, $name, $surname, $playingFee, $trans)
    {
        $content = "We hope your day is good. Thank you for your support. Please pay admin fee of R$playingFee(10% of your contribution) <br/>To:<br/>Institution: First National Bank <br/>Acc Holder: African Values Network <br/>Acc No. 6275 9831 011 <br/>Branch Code: 759 <br/>\nReference: $trans";
        Mailer::send('Emails/Welcome', ['title' => $name, 'content' => $content], function($message) use($email, $name, $surname)
        {
            $message->to($email, $name)->subject('Admin fee');
            $message->from('accounts@africanvaluesnetwork.org', 'African Values Network');
        });
        
    }
	
	public function verifySMS($name, $number, $payer, $paidAmount)
    {
		$user = "NuronTech";
		$password = "aSQPVPNZSNcfab";
		$api_id = "3486980";
		$baseurl ="http://api.clickatell.com";
		$text = urlencode("Good day $name. $payer has paid R$paidAmount into your account. Please login and confirm this payment. \n\n-African Values");
		$to = $number;
		$url = "$baseurl/http/sendmsg?user=$user&password=$password&api_id=$api_id&to=$to&text=$text";
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curl);
		curl_close($curl);
		$ret = $result;

        
    }
	
	public function verifyEmail($name, $email, $payer, $paidAmount)
    {
        $content = "We hope you are good $name. $payer has paid R$paidAmount into your account. Please click <a href=\"www.africanvalues.org\">HERE </a> to login and confirm this payment.";
        Mailer::send('Emails/Welcome', ['title' => $name, 'content' => $content], function($message) use($email, $name)
        {
            $message->to($email, $name)->subject('African Values Network: Verify payment');
            $message->from('accounts@africanvaluesnetwork.org', 'African Values Network');
        });
        
    }

	
	public function sponsorSMS($number, $name, $sponsorAmount, $institution, $payee, $account, $branch, $transid)
    {
		$text = urlencode("Good day $name. Please pay R$sponsorAmount\n To:\nInstitution: $institution\nAcc Holder: $payee\nAcc No.: $account\nBranch: $branch \nReference: $transid \n\n -African Values Network.\nOnce paid, wait 2 weeks for your Return on Investment.");
		
		$user = "NuronTech";
		$password = "aSQPVPNZSNcfab";
		$api_id = "3486980";
		$baseurl ="http://api.clickatell.com";
		$to = $number;
		$url = "$baseurl/http/sendmsg?user=$user&password=$password&api_id=$api_id&to=$to&text=$text";
		
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curl);
		curl_close($curl);
		$ret = $result;
          
    }
	
	public function sponsorEmail($email, $name, $sponsorAmount, $institution, $payee, $account, $branch, $transid)
    {
        $content = "We hope you are having a lovely day!. Please pay R$sponsorAmount <br/>To: <br/>Institution: $institution <br/>Acc Holder: $payee <br/>Acc No.: $account <br/>Branch: $branch <br/>Reference: $transid <br/><br/> Once you have paid this amount, Your Return on Investment will be paid within 2 weeks(14 days).";
        Mailer::send('Emails/Welcome', ['title' => $name, 'content' => $content], function($message) use($email, $name)
        {
            $message->to($email, $name)->subject('African Values Network: Admin fee');
            $message->from('accounts@africanvaluesnetwork.org', 'African Values Network');
        });
        
    }
    
    
}
