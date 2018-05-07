<?php
/**
 * Profile controller
 *
 * @author Carvelle
 * @version 1.0
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Play as PlayModel;

use View;
use Session;
use Redirect;
use App\Controllers\Communicate as Communicate;


/**
 * Sample controller showing 2 methods and their typical usage.
 */
class Play extends Controller
{
    protected $theme = 'Bootstrap';
    protected $layout = 'Custom';
    public $playModel;
	public $communicate;
    
    public function __construct()
    {
        parent::__construct();
        $this->playModel = new PlayModel();
		$this->communicate = new Communicate();
    }
    
    public function index()
    {
         Session::put('intendedurl', 'play');
        
        if (Session::get('login') == 'true') {
            $url = Session::get('intendedurl');
        } else {
            $url = 'login';
            return Redirect::to('login')->withStatus("Login Required");
        }
		
		$userData = Session::get('userData');
        
        return View::make('Play/index')
            ->shares('title', 'Play')
            ->with('userData', $userData[0]);
           
    }
    
    public function addPlayer()
    {
		$receipientList  = $this->playModel->getRecipients(Session::get('username'));
		$nonPayers = $this->playModel->getNonPayers(Session::get('username'));
        $amount = $_POST['amount'];
        $user = Session::get('username');
		$userData = Session::get('userData');
		
		
        
		if(count($receipientList) == 0 ){
			
			$nonPayer = count($nonPayers);
			
			if($nonPayer == 0){
				$data = array('payer' => $user,
						 'amount' => $amount,
						 'lasttrans'=> date('Y-m-d H:i:s'),
						  );
				$transid = $this->playModel->addPlayer($data);
				$this->communicate->playSMS(($data['amount'])*0.1, $user, "AFN-$transid");
				$this->communicate->playEmail($userData[0]->email, $userData[0]->name, $userData[0]->surname, ($data['amount'])*0.1, "AFN-$transid");
				echo "Amount was submitted successfully.";
			}
			else{
				
				if($nonPayers[0]->status == 1){
					
					$data = array('payer' => $user,
						 'amount' => $amount,
						 'lasttrans'=> date('Y-m-d H:i:s'),
						  );
					$transid = $this->playModel->addPlayer($data);
					$this->communicate->playSMS(($data['amount'])*0.1, $user, "AFN-$transid");
					$this->communicate->playEmail($userData[0]->email, $userData[0]->name, $userData[0]->surname, ($data['amount'])*0.1, "AFN-$transid");
					echo "Amount was submitted successfully.";
					
				}else{
					echo "Your Account is Barred Because of non-cooperation. Please consult an admin at admin@africanvalues.org for assistance";
				}
				
			}
		}

		else if(count($receipientList) > 0){
			
			echo "You cannot play while your current investment hasn't been completely paid. Should this not be the case, please consult an admin at admin@africanvalues.org";
		}
    }

}
