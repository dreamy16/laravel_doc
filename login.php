<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://clipboardjs.com/bower_components/primer-css/css/primer.css">
  <link rel="stylesheet" type="text/css" href="https://clipboardjs.com/assets/styles/main.css">
	<style type="text/css">
		textarea {
			background-color: #cccccc78;			
		}
	</style>
</head>
<body>
<div class="container ml-2 mr-2 mb-5">
 	
	  <!---Login time check role--->
	  <div class="row">
	 		<div class="col-12">
	 			<h2>Login time check role in logincontroller</h2>
	 			<?php 
	 			$password ='$user->password';
	 			$is_email_verify ='$user->is_email_verify';
	 			$status ='$user->status';
	 			$id ='$user->id';
	 			$role ='$user->role';
	 			$request ='$request';
	 			$user = '$user';
	 			$leaving_date = '$leaving_date';
	 			$errors = '$errors';
	 			$thiss  = '$this->username()';
	 			$requestpassword  = '$request->password';
	 			$expectsJson  = '$request->expectsJson()';
	 			$requestonly  = '$request->only';

	      		$helpfile = "
	      		protected function sendFailedLoginResponse(Request $request) {
			        $errors = [$thiss => trans('auth.failed')];

			        // Load user from database
			        $user = User::with('employee_detail')->where($thiss, $request->{$thiss})->first();

			        // Check if user was successfully loaded, that the password matches
			        // and active is not 1. If so, override the default error message.
			        if ($user && \Hash::check($requestpassword, $password) && $status == 'inactive') {
			            $errors = [$thiss => trans('auth.notactivated')];
			        }

			        if ($expectsJson) {
			            return response()->json($errors, 422);
			        }
			        return redirect()->back()
			                        ->withInput($requestonly($thiss, 'remember'))
			                        ->withErrors($errors);
			    }

			    public function authenticated(Request $request, $user) {
			        $leaving_date = '';
			        
			        
			        if ($status == 'inactive') {
			            \Auth::guard('web')->logout();
			            \Session::flash('status', 'Error!');
			            \Session::flash('alert-class', 'text-danger');
			            \Session::flash('message', 'Your account is inactive please contact to administration.');
			            return redirect('/login');
			        }elseif ($is_email_verify == 0) {
			            \Auth::guard('web')->logout();
			            \Session::flash('status', 'Error!');
			            \Session::flash('alert-class', 'text-danger');
			            \Session::flash('message', 'Your account is not verified. Please verified first.');
			            return redirect('/login');
			        }elseif (!empty($leaving_date) && $leaving_date < date('Y-m-d')) {
			            \Auth::guard('web')->logout();
			            \Session::flash('status', 'Error!');
			            \Session::flash('alert-class', 'text-danger');
			            \Session::flash('message', 'Your account is inactive please contact to administration.');
			            return redirect('/login');
			        }else{
			            User::where('id', $id)->update(array('last_login_time' => date('Y-m-d H:i:s')));
			            if($role=='company'){
			                return redirect()->route('company.dashboard');
			            }elseif($role=='manager'){
			                return redirect()->route('manager.dashboard');
			            }elseif($role=='employee'){
			                return redirect()->route('employee.dashboard');
			            }else{
			                return redirect()->route('dashboard');
			            }
			        }
			    }";

	      	?>
	      <div class="input-group">
	      	<textarea id="helpfile" rows="25" type="text" readonly value="<?php echo $helpfile; ?>"><?php echo $helpfile; ?></textarea>
	      	<span class="input-group-button">
	          <button class="btn" type="button" data-clipboard-demo="" data-clipboard-target="#helpfile">
	            <img class="clippy" src="https://clipboardjs.com/assets/images/clippy.svg" width="13" alt="Copy to clipboard">
	          </button>
	        </span>	     
	      </div>
	    </div>	    
		</div>
    
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
<script type="text/javascript">
	
var clipboardDemos = new Clipboard('[data-clipboard-demo]');

clipboardDemos.on('success', function(e) {
    e.clearSelection();

    console.info('Action:', e.action);
    console.info('Text:', e.text);
    console.info('Trigger:', e.trigger);

    showTooltip(e.trigger, 'Copied!');
});

clipboardDemos.on('error', function(e) {
    console.error('Action:', e.action);
    console.error('Trigger:', e.trigger);

    showTooltip(e.trigger, fallbackMessage(e.action));
});

// tooltips.js

var btns = document.querySelectorAll('.btn');

for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener('mouseleave', clearTooltip);
    btns[i].addEventListener('blur', clearTooltip);
}

function clearTooltip(e) {
    e.currentTarget.setAttribute('class', 'btn');
    e.currentTarget.removeAttribute('aria-label');
}

function showTooltip(elem, msg) {
    elem.setAttribute('class', 'btn tooltipped tooltipped-s');
    elem.setAttribute('aria-label', msg);
}
</script>
</body>
</html>
