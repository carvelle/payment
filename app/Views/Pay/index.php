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
	.spacer { margin-bottom: 30px}

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
        <div class="stats">
				<p class="stat"><span class="label label-info"><?php echo "12"; ?></span> Debtors</p>
				<p class="stat"><span class="label label-success"><?php echo "13"; ?></span> Creditors</p>
				<!--p class="stat"><span class="label label-danger">15</span> Overdue</p-->
		</div>

        <h1 class="page-title">Pay</h1>
                <ul class="breadcrumb">
        <li><a href="/dashboard">Home</a> </li>
        <li class="active">Pay</li>
        <li class="active"><?php $nameArr = $userData->name; echo strtolower($nameArr[0] .$userData->surname); ?></li>
    </ul>

    </div>
    <div class="main-content">
<div class="row">
    <div class="spacer col-sm-3 col-md-3">
		<button type="button" id = "refreshButton" class="btn btn-default">Refresh Table</button>
	</div>	
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-default" style="{overflow-x: scroll;}"> 
            <div class="panel-heading no-collapse">
                <span class="panel-icon pull-right">
                    <a href="#" class="demo-cancel-click" rel="tooltip" title="Click to refresh"><i class="fa fa-refresh"></i></a>
                </span>

                Pay Table
            </div>
            <table id = "paytable" class="table table-bordered table-striped display table-datatable table table-bordered table-striped table-hover table-heading table-datatable">
              <thead>
                <tr>
                    <th>Trans. id</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Date</th>
                    <th>Email</th>
                    <th>Amount</th>
					<th>Investment</th>
                    <th>Ref/Invest.</th>
                    <th>Pay</th>
                    
                </tr>
              </thead>
              
            </table>
            
        </div>
    </div>
 
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-default" style="{overflow-x: scroll;}"> 
            <div class="panel-heading no-collapse">
                <span class="panel-icon pull-right">
                    <a href="#" class="demo-cancel-click" rel="tooltip" title="Click to refresh"><i class="fa fa-refresh"></i></a>
                </span>

                Pay Table
            </div>
            <table id = "voidtable" class="table table-bordered table-striped display table-datatable table table-bordered table-striped table-hover table-heading table-datatable">
              <thead>
                <tr>
                    <th>id</th>
                    <th>Payee</th>
                    <th>Payer</th>
                    <th>Amount</th>
                    <th>Last Trans</th>
                    <th>Trans. Id</th>
					<th>Status</th>
					<th>Unban</th>  
                </tr>
              </thead>
              
            </table>
            
        </div>
    </div>
 
</div>		

        <footer>
            <hr>
            
            <p class="pull-right"><a href="" target="_blank">Financial Freedom for the people</a> by <a href="" target="_blank">African Values Network</a></p>
            <p>© 2017 <a href="" target="_blank">African Values Network</a></p>
        </footer>
    </div>
</div>


<script type="text/javascript">
    function getFullname(data, type, dataToSet) 
    {
    		return data.name +" " + data.surname ;
	}
    function getOutstandingAmount(data, type, dataToSet) 
    {
    		return data.initamount - data.committed ;
	}
	function getButton(data, type, dataToSet) {
    		return '<button pull-right" type="button" class="btn btn-default">Pay</button>';
	}
	
	function getButtonVoid(data, type, dataToSet) {
    		return (data.status === '0' ? '<button pull-right" type="button" class="btn btn-default">Clear</button>' : '<button pull-right" type="button" class="btn btn-disabled">Not Banned</button>');
	}
    
    function formatDate(data, type, dataToSet)
    {
       var split =  data.lasttrans.split(" ");
        return split[0];
        
    }
    function formatDate(data, type, dataToSet)
    {
       var split =  data.lasttrans.split(" ");
        return split[0];
        
    }
     function getReturns(data, type, dataToSet)
    {
       var returns =  (Number(data.credit)) - Number(data.committed);
        
        return returns;
        
    }
    
    $("[rel=tooltip]").tooltip();
    $(function() {
        $('.demo-cancel-click').click(function(){return false;});
    });
    $(document).ready(function() {
        var ptable = $('#paytable').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": "payuser",
             "columnDefs": [
                        {
                            "targets": [  ],
                            "visible": false
                        }
                    ],
            searchCols: [
                        { search: name },
                        null,
                        null,
                        null,
                        null,
                        null,

                   ],
                   "columns": [
                       { "data": "id" },
                       { "data": getFullname },
                       { "data": "username" },
                       { "data": formatDate },
                       { "data": "email" },
                       { "data": getReturns },
					   { "data": "initinvest" },
                       { "data": "reforinv" },
                       { "data": getButton },
                    ],
                        "aaSorting": [[ 0, "asc" ]],
            "sDom": "<'box-content'<'col-sm-6'f><'col-sm-6 text-right'l><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sSearch": "Search ",
                "sLengthMenu": '_MENU_'
            }


        } );
        
          $('#paytable tbody').on('click', 'tr', function () {
            var transactionid = $('td', this).eq(0).text();
            var payee = $('td', this).eq(2).text();
            var amount =   $('td', this).eq(5).text();
            var fullname = $('td', this).eq(1).text();

            $.ajax({
                    mimeType: 'text/html; charset=utf-8', // ! Need set mimeType only when run from local file
                    url: 'allocate',
                    type: 'POST',
                    success: function(data) {
                        alert(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    },
                    data:{'transcactionid':transactionid,'payee':payee, 'amount':amount}

                });

        }); 
		
	   $('#refreshButton').click(function(){
		$.ajax({url: "/cronrunner", success: function(result){	
			ptable.ajax.reload(null, false);
		  }});

		});
    });

	
   $(document).ready(function() {
        var ptable = $('#voidtable').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": "voiduser",
             "columnDefs": [
                        {
                            "targets": [  ],
                            "visible": false
                        }
                    ],

                   "columns": [
                       { "data": "id" },
                       { "data": "payee" },
                       { "data": "payer" },
                       { "data": "amount" },
                       { "data": formatDate },
                       { "data": "transid" },
					   { "data": "status" },
                       { "data": getButtonVoid },
                    ],
                        "aaSorting": [[ 0, "asc" ]],
            "sDom": "<'box-content'<'col-sm-6'f><'col-sm-6 text-right'l><'clearfix'>>rt<'box-content'<'col-sm-6'i><'col-sm-6 text-right'p><'clearfix'>>",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sSearch": "Search ",
                "sLengthMenu": '_MENU_'
            }


        } );
        
          $('#voidtable tbody').on('click', 'tr', function () {
            var transactionid = $('td', this).eq(0).text();
            var payee = $('td', this).eq(1).text();
            var payer =   $('td', this).eq(2).text();
            var transactionid = $('td', this).eq(5).text();
			  var status = $('td', this).eq(6).text();

            $.ajax({
                    mimeType: 'text/html; charset=utf-8', // ! Need set mimeType only when run from local file
                    url: 'removevoid',
                    type: 'POST',
                    success: function(data) {
						if(data !="")
                        alert(data);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    },
                    data:{'transactionid':transactionid,'payee':payee, 'payer':payer, 'status':status}

                });

        }); 
		
	   $('#refreshButton').click(function(){
		$.ajax({url: "/cronrunner", success: function(result){	
			ptable.ajax.reload(null, false);
		  }});

		});
    });

</script>


