<div class="wrap">
<hr/>
	<h1>Forwarding Services Plugin</h1>
	<hr/>
	<?php settings_errors(); ?>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab-1">Manage Settings</a></li>
		<li><a href="#tab-2">Errors</a></li>
		<li><a href="#tab-3">About</a></li>
	</ul>

	<div class="tab-content">
		<div id="tab-1" class="tab-pane active">
			
		</div>

		<div id="tab-2" class="tab-pane">
			<form method="post" action="options.php">
				<?php 
					do_settings_sections( 'alecaddd_plugin' );
					settings_fields( 'forwarding_service_error_handler' );
				
					submit_button();

				?>
			</form>
		</div>

		<div id="tab-3" class="tab-pane">
			<h3>About</h3>
		</div>
	</div>
</div>