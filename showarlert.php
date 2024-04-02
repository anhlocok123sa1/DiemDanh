<?php

if ($showAlert) {

    echo ' <div class="alert alert-success 
			alert-dismissible fade show" role="alert"> 
	
			<strong>Success!</strong> Your account is 
			now created and you can login. 
			<button type="button" class="close"
				data-dismiss="alert" aria-label="Close"> 
				<span aria-hidden="true">×</span> 
			</button> 
		</div> ';
}

if ($showError) {

    echo ' <div class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
		<strong>Error!</strong> ' . $showError . '
	
	<button type="button" class="close"
			data-dismiss="alert aria-label="Close"> 
			<span aria-hidden="true">×</span> 
	</button> 
	</div> ';
}

if ($exists) {
    echo ' <div class="alert alert-danger 
			alert-dismissible fade show" role="alert"> 
	
		<strong>Error!</strong> ' . $exists . '
		<button type="button" class="close"
			data-dismiss="alert" aria-label="Close"> 
			<span aria-hidden="true">×</span> 
		</button> 
	</div> ';
}

?>