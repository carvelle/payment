
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
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
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
            
            <h1 class="page-title">Details</h1>
                    <ul class="breadcrumb">
            <li><a href="/dashboard">Home</a> </li>
            <li><a href="/profile">Profile</a> </li>
            <li class="active"><?php $nameArr = $data[0]->name; echo strtolower($nameArr[0] .$data[0]->surname);?></li>
        </ul>

        </div>
        <div class="main-content">
            
<ul class="nav nav-tabs">
  <li class="active"><a href="#home" data-toggle="tab">Profile</a></li>
</ul>

<div class="row">
  <div class="col-md-12">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
            <form action="adduser" method="post">
                <div class="header">
            
                    <h1 class="page-title">Personal Information</h1>
                </div>
                <div class="form-group col-sm-12">
                    <div class=" col-sm-6">
				        <label class=" control-label h4">First Name*</label>
				        <input type="text" name="name"  disabled value ="<?php echo $data[0]->name;?>" id ="name" class="form-control">
			         </div>
			         <div class="col-sm-6">
				            <label class=" control-label h4">Surname*</label>
				            <input type="text" name="surname" disabled value ="<?php echo $data[0]->surname;?>" id = "surname" required="required" class="form-control" >
			         </div>
                </div>
                <div class="form-group col-sm-12">
                    <div class=" col-sm-6">
				        <label class=" control-label h4">Cellphone*</label>
				        <input type="text" name="cellular" disabled value ="<?php echo $data[0]->cellphone;?>" id ="cell" class="form-control">
			         </div>
			         <div class="col-sm-6">
				            <label class=" control-label h4">Email*</label>
				            <input type="text" name="email" disabled value ="<?php echo $data[0]->email;?>" id = "email" required="required" class="form-control" >
			         </div>
                </div>

                
                 <div class="clearfix"></div>
                <div class="header">
            
                    <h1 class="page-title">Banking Information</h1>
                </div>
                <div class="form-group col-sm-12">
                     <div class=" col-sm-6">
				        <label class=" control-label h4">Institution Name*</label>
				        <input type="text" name="bankname" disabled value ="<?php echo $data[0]->bankname;?>" id ="bank" class="form-control">
			         </div>
			         <div class="col-sm-6">
				            <label class=" control-label h4">Account Holder*</label>
				            <input type="text" name="holder" disabled value ="<?php echo $data[0]->bankaccholder;?>" id = "holder" required="required" class="form-control" >
			         </div>
                </div>
                <div class="form-group col-sm-12">
                     <div class=" col-sm-6">
				        <label class=" control-label h4">Account Number*</label>
				        <input type="text" name="accno" disabled value ="<?php echo $data[0]->bankacc ;?>" id ="accno" class="form-control">
			         </div>
			         <div class="col-sm-6">
				            <label class=" control-label h4">Branch Code*</label>
				            <input type="text"  disabled name="branch" value ="<?php echo $data[0]->bankbranch ;?>" id = "branch" required="required" class="form-control" >
			         </div>
                </div>
       
               
               
                    <div class="clearfix"></div>
            </form>
      </div>
    </div>
  </div>
</div>

<div class="modal small fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Delete Confirmation</h3>
      </div>
      <div class="modal-body">
        
        <p class="error-text"><i class="fa fa-warning modal-icon"></i>Are you sure you want to delete the user?</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
        <button class="btn btn-danger" data-dismiss="modal">Delete</button>
      </div>
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

