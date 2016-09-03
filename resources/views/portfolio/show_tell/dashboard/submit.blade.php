

<script src='https://www.google.com/recaptcha/api.js'></script>

<div class="row tab-row">

	<h4 class="page-header">Submit New Image</h4>

    <form method="POST" action="/show_tell/submit_image" class="form-horizontal" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

		<div class="form-group">
			<label for="name" class="col-sm-3 control-label">Image Name</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="name" id="name">
			</div>
		</div>
		<div class="form-group">
			<label for="image" class="col-sm-3 control-label">Image File</label>
			<div class="col-sm-9">
				<input type="file" class="form-control" name="image" id="image">
			</div>
		</div>

		<div class="form-group">
			<label for="email" class="col-sm-3 control-label"></label>
			<div class="col-sm-9">
				<div class="g-recaptcha" data-sitekey="6LeI0SgTAAAAAIgXWodkRM557GKlQb52tGol_64h"></div>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<button type="submit" class="btn btn-primary btn-block">Upload</button>
			</div>
		</div>
	</form>

</div>