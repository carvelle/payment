
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
<script src="lib/bootstrap/js/bootstrap.js"></script>


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
      <a class="" href="/dashboard"><span class="navbar-brand"><img src="/logo.png" style = "width:30px; height:30px;"></img></span></a>
    </div>

    <div class="navbar-collapse collapse" style="height: 1px;">

    </div>
</div>




<div class="col-sm-12 " style="background-color:white;">
    
            <div class="header">
            
                <h1 class="page-title" style="font-size:26pt;">Registration</h1>
            </div>
            <form id ="regForm" action="adduser" method="post">
                <div class="header">
            
                    <h1 class="page-title">Personal Information</h1>
                </div>
                <div class="form-group col-sm-12">
                    <div class=" col-sm-6">
				        <label class=" control-label">First Name*</label>
				        <input type="text"  required name="name" id ="name" class="form-control">
			         </div>
			         <div class="col-sm-6">
				            <label>Surname*</label>
				            <input type="text" required name="surname" id = "surname" required="required" class="form-control" >
			         </div>
                </div>
                <div class="form-group col-sm-12">
                    <div class=" col-sm-6">
				        <label class=" control-label">Cellphone*</label>
				        <input type="number" required name="cellular" onkeypress='validate(event)'  onchange='validate(event)' onpaste='validate(event)' oninput='validate(event)' id ="cell" class="form-control">
			         </div>
			         <div class="col-sm-6">
				            <label>Email*</label>
				            <input type="text" onchange ='ValidateEmail(this)' required name="email" id = "email" required="required" class="form-control" >
			         </div>
                </div>
                <div class="form-group col-sm-12">
                     <div class=" col-sm-6">
				        <label class=" control-label">I.D Number*</label>
				        <input type="number" required name="identification" onkeypress='validate(event)'  onchange='validate(event)' onpaste='validate(event)' oninput='validate(event)' id ="idnumber" class="form-control">
			         </div>
                </div>
                <div class="form-group col-sm-12">
                     <div class=" col-sm-6">
				        <label class=" control-label">Password*</label>
				        <input type="password" required name="password" id ="password" class="form-control">
			         </div>
			         
                </div>
                   <div class="form-group col-sm-12">
                     <div class=" col-sm-6">
				        <label class=" control-label">Verify*</label>
				        <input type="password" required name="verify" id ="verify" class="form-control">
			         </div>
			         
                </div>
                 <div class="header">
            
                    <h1 class="page-title">Contribution</h1>
                </div>
                
                <div class="form-group col-sm-12">
                     <div class=" col-sm-6">
				        <label class=" control-label">Amount*(minimum R500)</label>
				        <input type="number" onkeyup="this.value=this.value.replace(/[^\d]/,'')" value="500" required name="payment" id ="payment" onkeypress='validate(event)' onchange='validate(event)' onkeypress='validate(event)' onpaste='validate(event)' oninput='validate(event)' class="form-control">
			         </div>
                </div>    
                
                <div class="form-group col-sm-12">
                     <div class=" col-sm-6">
				        <label class="remember-me"><input checked="checked" value="yearly" type="radio" name="group"> Yearly</label>
                    
			         </div>
                </div>
                
                <div class="form-group col-sm-12">

			         <div class="col-sm-6">
				           
				        <label class="remember-me"><input type="radio" value = "quarterly" name = "group"> Quarterly</label>
			         </div>
                </div>
                <div class="header">
					<h1 class="page-title">Referrer</h1>
                </div>
                <div class="form-group col-sm-12">
                     <div class=" col-sm-6">
				        <label class=" control-label">Were You referred?</label>
				        <input type="checkbox" onchange='handleChange(this);' name="refcheck" id ="refcheck">
			         </div>
			         <div class="col-sm-6">
				            <label>Referrer Username(Cellphone number)</label>
				            <input type="number" disabled onchange='checkReferrer(this);' onkeypress='validate(event)'  onchange='validate(event)' onpaste='validate(event)' oninput='validate(event)' name="reftext" id = "reftext"  class="form-control" >
			         </div>
                </div>	
				
                 <div class="clearfix"></div>
                <div class="header">
					<h1 class="page-title">Banking Information</h1>
                </div>
                <div class="form-group col-sm-12">
                     <div class=" col-sm-6">
				        <label class=" control-label">Institution Name*</label>
				        <input type="text" required name="bankname" id ="bank" class="form-control">
			         </div>
			         <div class="col-sm-6">
				            <label>Account Holder*</label>
				            <input type="text" required name="holder" id = "holder" required="required" class="form-control" >
			         </div>
                </div>
                <div class="form-group col-sm-12">
                     <div class=" col-sm-6">
				        <label class=" control-label">Account Number*</label>
				        <input type="number"  onkeypress='validate(event)'  onchange='validate(event)' onpaste='validate(event)' oninput='validate(event)' required name="accno" id ="accno" class="form-control">
			         </div>
			         <div class="col-sm-6">
				            <label>Branch Code*</label>
				            <input type="number"  onkeypress='validate(event)'  onchange='validate(event)' onpaste='validate(event)' oninput='validate(event)' required name="branch" id = "branch" required="required" class="form-control" >
			         </div>
                </div>
                <div class="form-group col-sm-12">

			         <div class="col-sm-6">
				           
				         <div class="btn-toolbar list-toolbar">
			                 <button type = "submit" class="btn btn-primary">Register</button>
                    
			     </div>
			         </div>
                </div>
               
               
                    <div class="clearfix"></div>
            </form>

    <p><a href="privacy-policy.html" style="font-size: .75em; margin-top: .25em;">Privacy Policy</a></p>
</div>

<script type="text/javascript">
	
		$("[rel=tooltip]").tooltip();
		$(function() {
			$('.demo-cancel-click').click(function(){return false;});
		});


		function validate(evt) {
		  var theEvent = evt || window.event;
		  var key = theEvent.keyCode || theEvent.which;
		  key = String.fromCharCode( key );
		  var regex = /[0-9]|\./;
		  if( !regex.test(key) ) {
			theEvent.returnValue = false;
			if(theEvent.preventDefault) theEvent.preventDefault();
		  }
		}

		function handleChange(checkbox) {
			if(checkbox.checked == true){
				document.getElementById("reftext").disabled = false
			}else{
				document.getElementById("reftext").disabled = true;
			}
		}

		function checkReferrer(checkbox) {
			$.ajax({
				type: 'POST',
				url: '/checkreferrer',
				data: {reftext: document.getElementById("reftext").value},
				success: function (data) {		
					alert(data);
				},
				error: function (data) {
					 alert('An error occurred.');
				},
			});
		}

		function validate(evt) {
		  var theEvent = evt || window.event;
		  var key = theEvent.keyCode || theEvent.which;
		  key = String.fromCharCode( key );
		  var regex = /[0-9]|\./;
		  if( !regex.test(key) ) {
			theEvent.returnValue = false;
			if(theEvent.preventDefault) theEvent.preventDefault();
		  }
		}

		function ValidateEmail(textField)   
		{  
		 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(textField.value))  
		  {  
			return (true)  
		  }  
			alert("You have entered an invalid email address!")  
			return (false)  
		} 

		$( "#regForm" ).submit(function( event ) {

			var frm = $('#regForm');
			event.preventDefault();

			$.ajax({
				type: frm.attr('method'),
				url: frm.attr('action'),
				data: frm.serialize(),
				success: function (data) {
					alert(data);
					if(data.indexOf('success')){
						window.location.href = '/login';
					}
				},
				error: function (data) {
					 alert('An error occurred.');
					console.log(data);
				},
			});
		});
	
</script>




    
  
