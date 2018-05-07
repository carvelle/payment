<script type="text/javascript">
    $(function() {
        var match = document.cookie.match(new RegExp('color=([^;]+)'));
        if(match) var color = match[1];
        if(color) {
            $('body').removeClass(function (index, css) {
                return (css.match (/\btheme-\S+/g) || []).join(' ')
            })
            $('body').addClass('theme-' + color);
        }

        $('[data-popover="true"]').popover({html: true});

    });
</script>
 <script type="text/javascript">
    $(function() {
        $(".knob").knob();
    });
</script>
<style type="text/css">
    #line-chart {
        height:300px;
        width:800px;
        margin: 0px auto;
        margin-top: 1em;
    }
    .navbar-default .navbar-brand, .navbar-default .navbar-brand:hover { 
        color: #fff;
    }
    .panel {overflow-x: scroll; }
    .paid {background: '#00000000';}
    .confirm {background: '#00000000';}

</style>

<script type="text/javascript">
    $(function() {
        var uls = $('.sidebar-nav > ul > *').clone();
        uls.addClass('visible-xs');
        $('#main-menu').append(uls.clone());
    });
</script>

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Le fav and touch icons -->
<link rel="shortcut icon" type="image/x-icon" href="../assets/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">


<!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
<!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
<!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
<!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> 

<!--<![endif]-->

<div class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
  		<a class="" href="/dashboard"><span class="navbar-brand"><img src="/logo.png" style = "width:30px; height:30px;"></img></span></a></div>

    <div class="navbar-collapse collapse" style="height: 1px;">
      <ul id="main-menu" class="nav navbar-nav navbar-right">
        <li class="dropdown hidden-xs">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span> <?php echo $userData->name .' ' .$userData->surname; ?>
                <i class="fa fa-caret-down"></i>
            </a>

              <ul class="dropdown-menu">
                <li><a href="/profile">My Account</a></li>
                <li class="divider"></li>
                <li><a tabindex="-1" href="/userpay">Payments</a></li>
                <li class="divider"></li>
                <li><a tabindex="-1" href="logout">Logout</a></li>
              </ul>
        </li>
      </ul>

    </div>
  </div>
</div>


<div class="sidebar-nav">
<ul>
<li><a href="#" data-target=".dashboard-menu" class="nav-header" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i> Dashboard<i class="fa fa-collapse"></i></a></li>
    <li><ul class="dashboard-menu nav nav-list collapse in">
            <li><a href="/dashboard"><span class="fa fa-caret-right"></span> Dashboard</a></li>
            <li ><a href="/approve"><span class="fa fa-caret-right"></span> Approve</a></li>
            <li ><a href="/play"><span class="fa fa-caret-right"></span> Play</a></li>
            <?php if($userData->usergroup == 42) echo '<li ><a href="/userpay"><span class="fa fa-caret-right"></span> Pay</a></li>'; ?>
			<?php if($userData->usergroup == 42) echo '<li ><a href="/activate"><span class="fa fa-caret-right"></span> Activate Users</a></li>'; ?>
			<?php if($userData->usergroup == 42) echo '<li ><a href="/adminlogin"><span class="fa fa-caret-right"></span> Admin Login</a></li>'; ?>
    </ul></li>

    <li><a href="#" data-target=".accounts-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-briefcase"></i> Account <span class="label label-info">+3</span></a></li>
    <li><ul class="accounts-menu nav nav-list collapse">
            <li ><a href="/register"><span class="fa fa-caret-right"></span> Sign Up</a></li>
            <li ><a href="/profile"><span class="fa fa-caret-right"></span> Reset Password</a></li>
        <li ><a href="/profile"><span class="fa fa-caret-right"></span> Profile</a></li>
</ul></li>

</ul>
</div>

<div class="content">
    <div class="header">
        <div class="stats">
<p class="stat"><span class="label label-info"><?php echo count($payers); ?></span> Debtors</p>
<p class="stat"><span class="label label-success"><?php echo count($payees); ?></span> Creditors</p>
<!--p class="stat"><span class="label label-danger">15</span> Overdue</p-->
</div>

        <h1 class="page-title">Approve</h1>
                <ul class="breadcrumb">
        <li><a href="/dashboard">Home</a> </li>
        <li class="active">Approve</li>
        <li class="active"><?php $nameArr =$userData->name;  echo strtolower($nameArr[0] .$userData->surname); ?></li>            
    </ul>

    </div>
    <div class="main-content">


<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-default"> 
            <div class="panel-heading no-collapse">
                <span class="panel-icon pull-right">
                    <a href="#" class="demo-cancel-click" rel="tooltip" title="Click to refresh"><i class="fa fa-refresh"></i></a>
                </span>

                People you owe
            </div>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                    <th>Recipient Id</th>
                    <th>First Name</th>
                    <th>Username</th>
                    <th class ="hidden-xs hidden-sm">Date</th>
                    <th>Amount</th>
                    <th>Approve</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                      foreach($payees as $payee)
                      {
						  $paymentdate = (explode(" ", $payee->paymentdate));
                          $disabled;
                          $btn;
                          $btnName;
                          if($payee->completed >= 1){
                              
                              $disabled = 'disabled';
                              $btn = 'default';
                              $btnName = "Pending Approval";
                          }
                          else{
                              $disabled = '';
                              $btn = 'primary';
                              $btnName = 'I Paid';
                          }
                          echo '
                            <tr>
                                <td><p class="text-danger h4 pull-left" style="margin-top: 12px;">'.$payee->recipientid.'</p></td>
                              <td><p class="text-danger h4 pull-left" style="margin-top: 12px;">'.$payee->name.' ' .$payee->surname.'</p></td>
                              <td align = "center">
                              <p class="text-danger h4" style="margin-top: 12px;">'.$payee->payee.'</p>
                              <a href="/getdetail?payee='.$payee->payee.'"><p class="title">Get payment Information</p></a>
                              </td>
                              <td class ="hidden-xs hidden-sm"><p class="text-danger h4" style="margin-top: 12px;">'.$paymentdate[0].'</p></td>
                              <td><p class="text-danger h4 pull-right" style="margin-top: 12px;">R '.number_format($payee->amount).'</p></td>
                              <td align = "center"><button pull-right" '.$disabled.' type="button" id ="'.$payee->recipientid.'c'.$payee->payee.'c'.$payee->amount.'" class="btn btn-'.$btn.' paid">'.$btnName.'</button></td>
                            </tr>';
                      }
                    ?>          
              </tbody>
            </table>
        </div>
    </div>
 
</div>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-default"> 
        <div class="panel-heading no-collapse">
            <span class="panel-icon pull-right">
                <a href="#" class="demo-cancel-click" rel="tooltip" title="Click to refresh"><i class="fa fa-refresh"></i></a>
            </span>

            People that owe you
        </div>
        <table class="table table-bordered table-striped">
              <thead>
                <tr>
                    <th>Recipient Id</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th class ="hidden-xs hidden-sm">Date</th>
                    <th>Amount</th>
                    <th>Approve</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                      foreach($payers as $payer)
                      {
						  $paymentdate = (explode(" ", $payer->paymentdate));
                          $disabled;
                          $btn;
                          if($payer->completed < 1){
                              
                              $disabled = 'disabled';
                              $btn = 'default';
                          }
                          else{
                              $disabled = '';
                              $btn = 'success';
                          }
                          echo '
                            <tr>
                            <td><p class="text-danger h4 pull-left" style="margin-top: 12px;">'.$payer->recipientid.'</p></td>
                              <td><p class="text-danger h4 pull-left" style="margin-top: 12px;">'.$payer->name.' ' .$payer->surname.'</p></td>
                              <td><p class="text-danger h4 pull-left" style="margin-top: 12px;">'.$payer->payee.'</p></td>
                              <td class ="hidden-xs hidden-sm"><p class="text-danger h4 pull-left" style="margin-top: 12px;">'.$paymentdate[0].'</p></td>
                              <td><p class="text-danger h4 pull-right" style="margin-top: 12px;">R '.number_format($payer->amount).'</p></td>
                              <td align = "center"><button pull-right" type="button" id ="'.$payer->recipientid.'c'.$payer->payer.'c'.$payer->amount.'" class="btn btn-'.$btn.' confirm" '.$disabled.'>Confirm</button></td>
                            </tr>';
                      }
                    ?>          
              </tbody>
            </table>
    </div>
    </div>
</div>


        <footer>
            <hr>
			
            <p class="pull-right"><a href="" target="_blank">Econonic Freedom For Everyone</a> by <a href="" target="_blank"> African Values Network</a></p>
            <p>© 2018 <a href="" target="_blank">African Values Network</a></p>
        </footer>
    </div>
</div>


<script src="lib/bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
    $("[rel=tooltip]").tooltip();
    $(function() {
        $('.demo-cancel-click').click(function(){return false;});
    });
</script>
<script type="text/javascript">
    $('.paid').on('click', function() {
        var combined_string = $(this).attr('id');
        var exploded = combined_string.split("c");
        var transactionid =exploded[0] ;
        var payee = exploded[1];
		var amount = exploded[2];
        $.ajax({
          type: "POST",
          url: "ipaid",
            data:{transactionid:transactionid, payee:payee, amount:amount},
          
          
        });

    });
    
    $('.confirm').on('click', function() {
        var combined_string = $(this).attr('id');
        var exploded = combined_string.split("c");
        var transactionid =exploded[0] ;
        var payer = exploded[1];
		var amount = exploded[2];
        $.ajax({
          type: "POST",
          url: "confirm",
            data:{transactionid:transactionid, payer:payer, amount:amount},
          
          
        });

    });
</script>


