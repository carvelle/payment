<?php
/**
 * Dashboard controller
 *
 * @author Carvelle
 * @version 1.0
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Dashboard as DashboardModel;
use App\Models\Allocator as AllocationModel;

use View;
use Session;
use Redirect;


/**
 * Sample controller showing 2 methods and their typical usage.
 */
class Dashboard extends Controller
{

    protected $theme = 'Bootstrap';
    protected $layout = 'Custom';
    public $dashboardModel;
	public $allocatorModel;
    
    public function __construct()
    {
        parent::__construct();
        $this->dashboardModel = new DashboardModel();
		$this->allocatorModel = new AllocationModel();
    }
    /**
     * Create and return a View instance.
     */
    public function index()
    {
        Session::put('intendedurl', 'dashboard');
        
        if (Session::get('login') == 'true') {
            $url = Session::get('intendedurl');
        } else {
            $url = 'login';
            return Redirect::to('login')->withStatus("message");
        }
		$oweRepo = $this->allocatorModel->getTotalOwed();
		$AvalableRepo = $this->allocatorModel->getTotalAvailable();
		$committedRepo = $this->allocatorModel->getTotalCommitted();
		
		$totalOwed = 0;
		foreach($oweRepo as $owed){
			
			$totalOwed += $owed->initamount - $owed->committed;
		}
		
		$totalAvailable = 0;
		foreach($AvalableRepo as $available){
			
			$totalAvailable += $available->amount ;
		}
		
		$totalCommitted = 0;
		foreach($committedRepo as $committed){
			
			$totalCommitted += $committed->amount;
		}
		$userData = (Session::get('userData'));
        $payees = $this->getPayeeForTable();
        $payers = $this->getPayerForTable();
        $duePayments = $this->getDuePayments();
        $investmentProgress = $this->getInvestmentProgress();
        $paymentProgress = $this->getPaymentProgress();
        return View::make('Dashboard/index')
                    ->shares('title', 'Dashboard')
                    ->with('payees', $payees)
                    ->with('payers', $payers)
                    ->with('duePayments', $duePayments)
                    ->with('investmentProgress', $investmentProgress)
                    ->with('paymentProgress', $paymentProgress)
                    ->with('userData', $userData[0])
					->with('totalCommitted', $totalCommitted )
					->with('totalAvailable', $totalAvailable)
					->with('totalOwed', $totalOwed);
        
    }
    
    public function getPayeeForTable()
    {
        
        $username = Session::get('username');
        $payees = $this->dashboardModel->getPayeeForTable($username);
        
        return $payees;
    }
    
     public function getPayerForTable()
    {
        
        $username = Session::get('username');
        $payers = $this->dashboardModel->getPayerForTable($username);
        
        return $payers;
    }
    
    public function getDuePayments()
    {
        
        $username = Session::get('username');
        $duePayments = $this->dashboardModel->getDuePayments($username);
        
        return $duePayments;
    }

    public function getInvestmentProgress()
    {
        
        $username = Session::get('username');
        $investmentProgress = $this->dashboardModel->getInvestmentProgress($username);
        
        //echo print_r(Session::all());
     
        $investmentDate = date_create($investmentProgress[0]->createddate);
        $nowdate=date_create(date("Y-m-d H:i:s"));
        $diff=date_diff($investmentDate,$nowdate);
        $investment = $investmentProgress[0]->amount;
        $totalInvestment = $investmentProgress[0]->amount;
        
        if($investmentProgress[0]->group == 'yearly')
        {
            for($i = 0; $i < $diff->format("%R%a"); $i++)
            {
              $investment += $investment * 0.01 ;   
            }
            
            for($i = 0; $i < 365; $i++)
            {
              $totalInvestment += $totalInvestment * 0.01 ;   
            }
            
        }
        else if($investmentProgress[0]->group == 'quarterly')
        {
            
            for($i = 0; $i < $diff->format("%R%a"); $i++)
            {
              $investment += $totalInvestment * 0.01 ;  
                
            }
            
            for($i = 0; $i < 91; $i++)
            {
              $totalInvestment += $totalInvestment * 0.01 ;   
            }
            
        }
        
        $investmentData = array('investment' => floor($investment),
                               'total' => floor($totalInvestment)
                               );
        

        return $investmentData;
    }
    
    public function getPaymentProgress()
    {
        $username = Session::get('username');
        $trans = $this->dashboardModel->getLastTransactionid($username);
        if(count($trans) > 0){
            $id = $trans[0]->transactionid;
            $paid = $this->dashboardModel->getPaymentProgress($username, $id);
            $total = 0;

            foreach($paid as $amount)
            {

                $total += $amount->paidamount;
            }

            $data = array('total' => $trans[0]->initamount,
                         'amount' =>$total );

            return $data;
        }
        return array('total' => 0,
                     'amount' =>0 );
    }
   
}
