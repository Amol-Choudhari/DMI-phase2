<?php ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta name="viewport" content="width=device-width,initial-scale=1">
			<?php //ALL PLUGINS CSS				
				echo $this->Html->css('../dashboard/plugins/fontawesome-free/css/all.min');
				echo $this->Html->css('../dashboard/dist/css/adminlte.min');
				echo $this->Html->css('../dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min');
				echo $this->Html->css('../dashboard/plugins/daterangepicker/daterangepicker');
				//Fetch Charset
				echo $this->Html->meta('icon');
				echo $this->Html->charset();
				//Fetch Meta Elements
				echo $this->fetch('meta');
				echo $this->fetch('css');
				echo $this->fetch('script');
				//Load CSS Files
				echo $this->Html->css('font-awesome.min');
				echo $this->Html->css('bootstrap.min');
				echo $this->Html->css('../dashboard/css/datepicker3');
				echo $this->Html->css('../dashboard/css/bootstrap-glyphicons.min');
				echo $this->Html->css('dataTables.bootstrap.min');
				echo $this->Html->css('jquery-confirm.min');
				//Load JS Files
				echo $this->Html->script('jquery_main.min');
				echo $this->Html->script('jquery.dataTables.min');
				echo $this->Html->script('dataTables.bootstrap.min');
				echo $this->Html->script('bs-custom-file-input.min');
				echo $this->Html->script('jquery-confirm.min');
			?>

			<title>DEVS-DMI</title>
		</head>
		<body class="hold-transition sidebar-mini layout-fixed bg-dark">
			<div class="wrapper main-header">
  				<?php echo $this->fetch('content'); ?>
			</div>


		<?php //ALL PLUGINS SCRIPTS
			echo $this->Html->script("../dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js");
			echo $this->Html->script("../dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js");
			echo $this->Html->script("../dashboard/dist/js/adminlte.js");
		?>
		
		<?php // Date Picker and Message Box 
			echo $this->Html->script('bootstrap.min'); 
			echo $this->Html->script('../dashboard/js/bootstrap-datepicker');
			if(!empty($message)){ echo $this->element('message_boxes'); }
		?>

	</body>
</html>
