<?php include('header.php'); ?>


	<div class="container" style="margin-top: 20px;">
		<h1>Admin Form</h1>

		<?php echo form_open('Admin/index'); ?>

		<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
					<label for="Username">Username:</label>
					<?php echo form_input(['class'=>'form-control', 'placeholder'=>'Enter Username', 'name'=>'uname', 'value'=>set_value('uname')]); ?>
				</div>
			</div>
			<div class="col-lg-6">
				<?php form_error('uname') ?>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
					<label for="Password">Password:</label>
					<?php echo form_input(['type'=>'password', 'class'=>'form-control', 'placeholder'=>'Enter Password', 'name'=>'pass', 'value'=>set_value('pass')]);   ?>
				</div>
			</div>
			<div class="col-lg-6">
				<?php form_error('uname') ?>
			</div>
		</div>

		<?php echo form_submit(['type'=>'submit', 'class'=>'btn btn-primary', 'value'=>'Submit']) ?>
		<?php echo form_reset(['type'=>'reset', 'class'=>'btn btn-warning', 'value'=>'Reset']) ?>
	</div>

<?php include('footer.php'); ?>