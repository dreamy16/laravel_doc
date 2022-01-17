<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>custom middleware</title>
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
 	
	  <!---Create CheckAccess.php file--->
	  <div class="row">
	 		<div class="col-12">
	 			<h2>php artisan make:middleware CheckAccess (Created CheckAccess.php file)</h2>
	 			
	 			<?php 
	 			$request ='$request';
	 			$next = '$next';
	 			$modulecode = '$modulecode';
	 			

	      		$helpfile = "
	      		public function handle($request, Closure $next,$modulecode)
			    {
			       
			        if(Auth::user()->role == 'company' && PermissionForModule($modulecode)) {
			            return $next($request);
			        }
			        if(PermissionForModule($modulecode))
			        {
			            return $next($request);
			        }else
			        {
			            return response()->view('errors.unauthorized');
			        }
			    }";

	      	?>
	      <div class="input-group">
	      	<textarea id="helpfile" rows="15" type="text" readonly value="<?php echo $helpfile; ?>"><?php echo $helpfile; ?></textarea>
	      	<span class="input-group-button">
	          <button class="btn" type="button" data-clipboard-demo="" data-clipboard-target="#helpfile">
	            <img class="clippy" src="https://clipboardjs.com/assets/images/clippy.svg" width="13" alt="Copy to clipboard">
	          </button>
	        </span>	     
	      </div>
	    </div>	    
		</div>
    <!---kerner.php file--->
	  <div class="row">
	 		<div class="col-12">
	 			<h2>Define middleware in kerner.php file</h2>
	 			
	 			<?php 	 			
	 			$routeMiddleware = '$routeMiddleware';
	      		$proute = "
	      		protected $routeMiddleware = ['check-access' => \App\Http\Middleware\CheckAccess::class,]";

	      	?>
	      <div class="input-group">
	      	<textarea id="proute" rows="2" type="text" readonly value="<?php echo $proute; ?>"><?php echo $proute; ?></textarea>
	      	<span class="input-group-button">
	          <button class="btn" type="button" data-clipboard-demo="" data-clipboard-target="#proute">
	            <img class="clippy" src="https://clipboardjs.com/assets/images/clippy.svg" width="13" alt="Copy to clipboard">
	          </button>
	        </span>	     
	      </div>
	    </div>	    
		</div>
		<!---use in route file--->
	  <div class="row">
	 		<div class="col-12">
	 			<h2>Used in route file file</h2>
	 			
	 			<?php 	 			
	 			
	      		$routegroup = "
	      		Route::group(['middleware' => ['check-access:m9']], function () {
			    	Route::group(['prefix' => 'company', 'as' => 'company.'], function () {
				        /***************** Profile *************************/
				        Route::get('profile', ['as' => 'profile', 'uses' => 'ProfileController@index']);
				    });
				});";

	      	?>
	      <div class="input-group">
	      	<textarea id="routegroup" rows="6" type="text" readonly value="<?php echo $routegroup; ?>"><?php echo $routegroup; ?></textarea>
	      	<span class="input-group-button">
	          <button class="btn" type="button" data-clipboard-demo="" data-clipboard-target="#routegroup">
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
