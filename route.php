<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
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
 		<!---Basic route middleware--->
 		<div class="row">
	 		<div class="col-12">
	 			<h2>Basic route middleware</h2>
	      <div class="input-group">
	      	<?php 
	      		$route = "Route::group(['middleware' => ['web']], function() {
	      			Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function (){ 
	      				Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);
	      				Route::resource('fileupload', 'FileUploadController');        
				        Route::group(['prefix' => 'fileupload','as' => 'fileupload.',], function () {
				            Route::post('getall', ['as' => 'getall', 'uses' => 'FileUploadController@getall']);
				            Route::post('getmodal', ['as' => 'getmodal', 'uses' => 'FileUploadController@getmodal']);
				            Route::post('changestatus', ['as' => 'changestatus', 'uses' => 'FileUploadController@changeStatus']);
				        });
	      			}); 
	      		});";

	      	?>
	      	<textarea id="foo" rows="4" type="text" readonly value="<?php echo $route; ?>"><?php echo $route; ?></textarea>
	      	<span class="input-group-button">
	          <button class="btn" type="button" data-clipboard-demo="" data-clipboard-target="#foo">
	            <img class="clippy" src="https://clipboardjs.com/assets/images/clippy.svg" width="13" alt="Copy to clipboard">
	          </button>
	        </span>
	     
	      </div>
	    </div>
	  </div>
	  <hr>
	  <!---Create helpers file(app/http/helpers.php)--->
	  <div class="row">
	 		<div class="col-12">
	 			<h2>Create helpers file(app/Http/helpers.php) then call in composer.json file</h2>
	 			<?php 
	      		$helpfile = '
	      		"autoload":
				    {
				        "files": [
				            "app/Http/helpers.php"
				        ],
				        "psr-4":{ }
				    }';

	      	?>
	      <div class="input-group">
	      	<textarea id="helpfile" rows="4" type="text" readonly value="<?php echo $helpfile; ?>"><?php echo $helpfile; ?></textarea>
	      	<span class="input-group-button">
	          <button class="btn" type="button" data-clipboard-demo="" data-clipboard-target="#helpfile">
	            <img class="clippy" src="https://clipboardjs.com/assets/images/clippy.svg" width="13" alt="Copy to clipboard">
	          </button>
	        </span>	     
	      </div>
	    </div>
	    
		</div>
    <hr>
 		 <!---custom middleware--->
 		<div class="row">
	 		<div class="col-12">
	 			<h2>Custom Middleware Route (web.php)</h2>
	 			<?php 
	      		$customroute = "Route::group(['middleware' => ['check-permission:company']], function () {
	      			Route::group(['prefix' => 'company', 'as' => 'company.'], function () {
	      			}); 
	      		});";

	      	?>
	      <div class="input-group">
	      	<textarea id="customroute" rows="4" type="text" readonly value="<?php echo $customroute; ?>"><?php echo $customroute; ?></textarea>
	      	<span class="input-group-button">
	          <button class="btn" type="button" data-clipboard-demo="" data-clipboard-target="#customroute">
	            <img class="clippy" src="https://clipboardjs.com/assets/images/clippy.svg" width="13" alt="Copy to clipboard">
	          </button>
	        </span>	     
	      </div>
	    </div>
	    <div class="col-12">
	    	<h2>Create file (CheckPermission.php)</h2>
	    	<?php 
	    			/*variable define only for error not used in code*/
	    			$request = '$request';
	    			$next = '$next';
	    			$permission ='$permission';
	      		$checkper = "
	      		public function handle($request, Closure $next, $permission) {
				        $permission = explode('|', $permission);
				        
				        if(checkPermission($permission)){
				            return $next($request);
				        }
				        return response()->view('errors.unauthorized');
				    }";

	      	?>
	      <div class="input-group">
	      	<textarea id="checkper" rows="4" type="text" readonly value="<?php echo $checkper; ?>"><?php echo $checkper; ?></textarea>
	      	<span class="input-group-button">
	          <button class="btn" type="button" data-clipboard-demo="" data-clipboard-target="#checkper">
	            <img class="clippy" src="https://clipboardjs.com/assets/images/clippy.svg" width="13" alt="Copy to clipboard">
	          </button>
	        </span>	     
	      </div>
	    </div>
	    <div class="col-12">
	    	<h2>Helper function</h2>
	    	<?php 
	    			/*variable define only for error not used in code*/
	    			
	    			$key ='$key';
	    			$value ='$value';
	    			$userAccess ='$userAccess';
	    			$permissions ='$permissions';
	      		$help_permission = "
	      		function checkPermission($permissions){
						    if (auth()->check()) {
						        $userAccess = auth()->user()->role;
						        foreach ($permissions as $key => $value) {
						            if ($value == $userAccess) {
						                return true;
						            }
						        }
						        return false;
						    } else {
						        return false;
						    }
						}";

	      	?>
	      <div class="input-group">
	      	<textarea id="help_permission" rows="4" type="text" readonly value="<?php echo $help_permission; ?>"><?php echo $help_permission; ?></textarea>
	      	<span class="input-group-button">
	          <button class="btn" type="button" data-clipboard-demo="" data-clipboard-target="#help_permission">
	            <img class="clippy" src="https://clipboardjs.com/assets/images/clippy.svg" width="13" alt="Copy to clipboard">
	          </button>
	        </span>	     
	      </div>
	    </div>
		</div>
		<hr>
		<!---API Route(api.php)--->
	  <div class="row">
	 		<div class="col-12">
	 			<h2>API Route(api.php)</h2>
	 			<h4>passport install</h4>
	 			<h4>config/auth.php - guards 'api' => [
            'driver' => 'passport',
            'provider' => 'users',
        ],</h4>
	 			<?php 
	      		$apiroute = "
	      		Route::group(['middleware' => 'auth:api'], function () {
						    Route::post('logout', 'Api\AuthenticationController@logout');
						})";

	      	?>
	      <div class="input-group">
	      	<textarea id="apiroute" rows="4" type="text" readonly value="<?php echo $apiroute; ?>"><?php echo $apiroute; ?></textarea>
	      	<span class="input-group-button">
	          <button class="btn" type="button" data-clipboard-demo="" data-clipboard-target="#apiroute">
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
