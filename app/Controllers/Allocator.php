<?php
/**
 * Allocator controller
 *
 * @author Carvelle
 * @version 1.0
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Allocator as AllocationModel;
use App\Models\Referrer as ReferrerModel;
use App\Controllers\Communicate as Communicate;
use App\Models\Users as UsersModel;


use View;
use Session;
use Redirect;


class Allocator extends Controller
{
    protected $theme = 'Bootstrap';
    protected $layout = 'custom';
    public $allocationModel;
	public $referrerModel;
	public $usersModel;
	public $communicate;
    
    public function __construct()
    {
        parent::__construct();
        $this->allocationModel = new AllocationModel();
		$this->referrerModel = new ReferrerModel();
		$this->communicate = new Communicate();
		$this->usersModel = new UsersModel();
    }
    
    
    public function getPayers($payee)
    {
        $payers = $this->allocationModel->getPayers($payee);
        
        return $payers;
    }
    public function allocate()
    {
         Session::put('intendedurl', 'allocate');
        
        if (Session::get('login') == 'true') {
            $url = Session::get('intendedurl');
        } else {
            $url = 'login';
            return Redirect::to('login')->withStatus("Login Required");
        }
        
        $username = trim($_POST['payee']);
        $debit = trim($_POST['amount']);
        $recipientid = trim($_POST['transcactionid']);
		$payeeInfo = $this->usersModel->getUserDetails($username);
		$payerCount = 0;
        
        do{ 
            $payers = $this->getPayers($username);
			$payerCount = count($payers);
            if($payerCount == 0){
                echo "no money available";
                break;
            }
            $chosenAmount = $payers[0]->amount;
            $chosenPayer = $payers[0];
            $current;
            $amount = $debit;
            $checkRatio = 0;
            $gapSet = 1000000;
			
   
            foreach ($payers as $payer)  
            {
                $gap = 0;
                
                
                $credit = $payer->amount;
                $committed = $payer->committed;
                $current = $credit - $committed;
                $gap = sqrt(abs(pow($current, 2) - pow($amount,2)));
                
                if($gap < $gapSet)
                {
                    echo "distance " .$gap ." " .$current ." " .$amount ."/";
                    $chosenPayer = $payer;
                    $gapSet = $gap;
                }
                /*else
                {
                    $chosenPayer = $payers[0];
                }*/
            }  
		
            $current = $chosenPayer->amount - $chosenPayer->committed;
            if($debit > $current )
            {
                $amount = $current;
            }
            else if($debit < $current){

                $amount = $debit;
            }
            else{

                $amount = $debit;
            }

			$payerInfo = $this->usersModel->getUserDetails($chosenPayer->payer);
			$this->communicate->sponsorSMS($payerInfo[0]->cellphone, $payerInfo[0]->name, $amount, $payeeInfo[0]->bankname, $payeeInfo[0]->bankaccholder, $payeeInfo[0]->bankacc, $payeeInfo[0]->bankbranch, "TRANS-$recipientid") ;
			$this->communicate->sponsorEmail($payerInfo[0]->email, $payerInfo[0]->name, $amount, $payeeInfo[0]->bankname, $payeeInfo[0]->bankaccholder, $payeeInfo[0]->bankacc, $payeeInfo[0]->bankbranch, "TRANS-$recipientid") ;
			
            $transData = array('payer' => $chosenPayer->payer,
                          'payee' => $username,
                          'amount' => $amount,
                          'recipientid' => $recipientid,
                            'payerid' => $chosenPayer->id,
                          'paymentdate' => date('Y-m-d H:i:s'),
                         );
            
            

            $this->allocationModel->addTransaction($transData);
            $this->allocationModel->updateLasttrans( array('lasttrans' => date('Y-m-d H:i:s') ), $chosenPayer->id);
            $this->allocationModel->updateTouched( array('touched' => 1) , $chosenPayer->id);
            
            //Check if payee exist in recipients
            $exist = $this->allocationModel->checkRecipient($recipientid);
            
            if(count($exist) > 0){
                $completed = 0;
                if(($amount + ($exist[0]->committed)) >= $exist[0]->initamount){
                    
                    echo "amount ".$amount ." committed ".$exist[0]->committed ." init amount ".$exist[0]->initamount;
                  $completed = 1;  
                }
                
                $recipientData = array('committed' => $amount + $exist[0]->committed,
                                'lasttrans' => date('Y-m-d H:i:s'),
                                'completed' => $completed,
                         );
                $this->allocationModel->updateRecipient($recipientData, $recipientid);
            }
          
            
            //adding new commited amount based on the amount paid
            $debit = $debit - $amount;
            $dataById = $this->allocationModel->getCommitted($chosenPayer->id);
            $currentCommitted = $dataById[0]->committed;
            $newCommitted = $currentCommitted + $amount;
            $dataCommit = array('committed' => $newCommitted);
            $this->allocationModel->updateCommitted($dataCommit, $chosenPayer->id);
            //check if user still has money
            if($chosenPayer->amount  - $newCommitted < 50) 
            {
                echo $newCommitted .' ' .$chosenPayer->amount;
                $satData = array('nomoney' =>  1,
                                'completed' => 1);
                $where =  $chosenPayer->id;
                $this->allocationModel->playerSaturated($satData, $where);
            }   
           
            //$this->allocationModel->updateCommited();
           
           if($debit < 10){
               
               $paid = array('paid' => 1);
               $where = $recipientid;
               
               //update donors that player has been payed
               $this->allocationModel->playerPaid($paid, $where);
               //updated recipient has been paid
               $completed = array('completed' => 1);
               $this->allocationModel->recipientPaid($completed, $where);
           }
			
       }while($debit > 0 && $payerCount > 0);
    }
    
    
    public function  cronRunner(){
        
        
        $recipients = $this->allocationModel->moveDonorToRecipient();
		$referrers = $this->referrerModel->sumRefAmount();
        
        foreach($recipients as $recipient){
            $maxId = $this->referrerModel->getMaxRecipientId();
			$adjustedAmout = ($recipient->amount) + (0.8) *($recipient->amount);
            $data = array('payee' => $recipient->payer,
                         'initamount' => $adjustedAmout,
						 'initinvest' => $recipient->amount,
						  'reforinv' => 'Investor',
                         'transactionid' => $maxId + 1);
            $updateDonor = array('queued' => 1);
            $updateWhere = array('id' => $recipient->id);
            
            $this->allocationModel->updateQueued($updateDonor, $updateWhere);
            $this->allocationModel->addRecipient($data);
        }
        
		foreach($referrers as $referrer){
			$maxId = $this->referrerModel->getMaxRecipientId();
			$regDate = date_create($referrer->refdate);
			$nowdate=date_create(date("Y-m-d H:i:s"));
            $diff=date_diff($regDate, $nowdate);
			if($diff->format("%R%a") > 31){
				$maxId = $this->referrerModel->getMaxRecipientId();
				 $data = array('payee' => $referrer->referrer,
                         'initamount' => $referrer->sumbonus,
						 'reforinv' => 'Referrer',
						 'initinvest' => $referrer->sumbonus,
                         'transactionid' => $maxId + 1);
				
				$updateRef = array('status' => 2);
				$this->allocationModel->addRecipient($data);
				$this->referrerModel->updateRefStatus($updateRef, $referrer->referrer, $referrer->referred);
				
			}
		}
        
       $this->voidTransaction(); 
        
        
    }
    public function voidTransaction()
    {
        
        $unpaidTransactions = $this->allocationModel->unpaidTransactions();
        
        foreach($unpaidTransactions as $unpaid)
        {
            
            $unpaidDate = date_create($unpaid->paymentdate);
            $nowdate=date_create(date("Y-m-d H:i:s"));
            $diff=date_diff($unpaidDate,$nowdate);
            
            if($diff->format("%R%a") > 14) //payment has been voided
            {   $recipient = $this->allocationModel->getRecipientByPayee($unpaid->recipientid, $unpaid->payee);
                $reducedCommitted = ($recipient[0]->committed) - $unpaid->amount;
                $updateData = array('completed' => 3);
                $where = array('recipientid' => $unpaid->recipientid,
                              'payerid' => $unpaid->payerid,
                              'id' => $unpaid->id
                              );
                //add to voided table
                $voidedData = array('_payer' => $unpaid->payer,
                                   '_payee' => $unpaid->payee,
                                   'unpaidamount' => $unpaid->amount,
                                   'transactionid' => $unpaid->recipientid,
                                   'lasttrans' => $unpaid->paymentdate);
             
                $updateRecipient = array('committed' => $reducedCommitted,
                                        'completed' => 0);
                $whereRecipient = array('transactionid' => $unpaid->recipientid);
                
                $this->allocationModel->addToVoided($voidedData);
                $this->allocationModel->updateTransactionComplete($updateData, $where);
                $this->allocationModel->updateRecipientForVoided($updateRecipient, $whereRecipient);
             
                
            }
            
        }
     
            //echo count($unpaidTransactions)." " ."This is the vlue of the voided result array";
        
    }


}
