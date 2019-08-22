<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title><?php echo $title; ?></title>

		<link href="<?php echo base_url('assets/AdminLTE/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/AdminLTE/dist/css/AdminLTE.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/AdminLTE/dist/css/skins/_all-skins.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/AdminLTE/fonts/font-awesome-4.7.0/css/font-awesome.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/sweetalert2/package/dist/sweetalert2.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/datetimepicker/css/bootstrap-datetimepicker.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/plugins/bootstrap-toggle/bootstrap-toggle.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/plugins/jquery-editable-select-master/dist/jquery-editable-select.min.css');?>" rel="stylesheet">
			
		<link href="<?php echo base_url('assets/AdminLTE/fonts/ionicons.min.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css');?>" rel="stylesheet">
		<link href="<?php echo base_url('assets/daterangepicker/daterangepicker.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/AdminLTE/plugins/select/css/bootstrap-select.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/plugins/bootstrap-select/bootstrap-select.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/AdminLTE/plugins/select2/css/select2.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/custom.css');?>" rel="stylesheet">
        
		<script src="<?php echo base_url('assets/AdminLTE/plugins/jQuery/jQuery-3.4.1.min.js');?>"></script>
		<script src="<?php echo base_url('assets/AdminLTE/bootstrap/js/bootstrap.min.js');?>"></script>
		<script src="<?php echo base_url('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js');?>"></script>
		<script src="<?php echo base_url('assets/AdminLTE/plugins/input-mask/jquery.inputmask.js'); ?>"></script>
		<script src="<?php echo base_url('assets/AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js'); ?>"></script>
		<script src="<?php echo base_url('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
		<script src="<?php echo base_url('assets/AdminLTE/dist/js/demo.js');?>"></script>
		<script src="<?php echo base_url('assets/daterangepicker/moment.min.js');?>"></script>
		<script src="<?php echo base_url('assets/daterangepicker/daterangepicker.js');?>"></script>
		<script src="<?php echo base_url('assets/sweetalert2/package/dist/sweetalert2.min.js');?>"></script>
		<script src="<?php echo base_url('assets/plugins/bootstrap-toggle/bootstrap-toggle.min.js');?>"></script>
		<script src="<?php echo base_url('assets/plugins/cleave/dist/cleave.min.js');?>"></script>
		<script src="<?php echo base_url('assets/AdminLTE/plugins/select2/js/select2.min.js');?>"></script>
		<script src="<?php echo base_url('assets/plugins/bootstrap-select/bootstrap-select.min.js');?>"></script>
		<script src="<?php echo base_url('assets/vuejs/vue.min.js');?>"></script>
		<script src="<?php echo base_url('assets/datetimepicker/js/bootstrap-datetimepicker.min.js');?>"></script>

	</head>
	<body class="hold-transition skin-red sidebar-mini fixed">
		<div class="wrapper">
			<?php $this->load->view('template/header.php'); ?>
			<?php $this->load->view('template/sidebar_menu.php'); ?>
			<div class="content-wrapper">
				<section class="content-header">
					<div class="row">
						<div class="col-md-6"><h3><?php echo $head_title; ?> </h3></div>
						<div class="col-md-6 text-right" ><h6 id='date-part'></h6></div>
					</div>
				
				</section>
				<?php $this->load->view($content); ?>
			</div>
			<?php $this->load->view('template/footer.php'); ?>	
			<?php $this->load->view('template/control_sidebar.php'); ?>
		</div>
	</body>
</html>
<script>

$(document).ready(function() {
    var interval = setInterval(function() {
        var momentNow = moment();
        $('#date-part').html(momentNow.format('MMMM DD, YYYY  hh:mm:ss A') + ' '
                            + momentNow.format('dddd')
                           );
        $('#time-part').html(momentNow.format(' '));
    }, 100);
    
    $('#stop-interval').on('click', function() {
        clearInterval(interval);
    });
});


</script>