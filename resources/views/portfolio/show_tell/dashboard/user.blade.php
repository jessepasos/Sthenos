<div class="row tab-row">

	<h4 class="page-header">Update Profile Information</h4>
    <form method="POST" action="/show_tell/update_info" class="form-horizontal">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<div class="form-group">
			<label for="email" class="col-sm-3 control-label">Email</label>
			<div class="col-sm-9">
				<input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $objData->user['email']; ?>">
			</div>
		</div>

		<div class="form-group">
			<label for="username" class="col-sm-3 control-label">Username</label>
			<div class="col-sm-9">
				<input type="username" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $objData->user['name']; ?>">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<button type="submit" class="btn btn-primary btn-block">Update Profile</button>
			</div>
		</div>
	</form>


	<h4 class="page-header">Update Account Password</h4>
    <form method="POST" action="/show_tell/update_password" class="form-horizontal">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		<div class="form-group">
			<label for="old-password" class="col-sm-3 control-label">Old Password</label>
			<div class="col-sm-9">
				<input type="password" class="form-control" name="old-password" id="old-password">
			</div>
		</div>

		<div class="form-group">
			<label for="new-password" class="col-sm-3 control-label">New Password</label>
			<div class="col-sm-9">
				<input type="password" class="form-control" name="new-password" id="new-password">
			</div>
		</div>

		<div class="form-group">
			<label for="repeat-password" class="col-sm-3 control-label">Repeat Password</label>
			<div class="col-sm-9">
				<input type="password" class="form-control" name="repeat-password" id="repeat-password">
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<button type="submit" class="btn btn-primary btn-block">Update Password</button>
			</div>
		</div>
	</form>

</div>