<div class="row tab-row">

	<h4 class="page-header">Comments Recieved</h4>
	<div class="row">
		<?php $blnCheck = false; ?>
		<?php foreach ($objData->comments['recieved'] as $intImageId => $arrComments) { ?>
			<?php $blnCheck = empty($arrComments) ? false : true; ?>
			<?php foreach ($arrComments as $intKey => $objValue) { ?>
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-2">

                   		<a data-toggle="modal" data-target="#imageModal" data-image="<?php echo $objValue->image_id; ?>">
						<div class="thumbnail">
							<img class="img-responsive user-photo" src="\public\uploads\show_tell\<?php echo $objValue->resource; ?>">
							<div class="caption">
								<?php echo $objValue->image_name; ?>
							</div>
						</div>
						</a>
					</div>

					<div class="col-sm-10">
						<div class="panel panel-default">
							<div class="panel-body">
								<?php echo $objValue->text; ?>
							</div>
							<div class="panel-footer">
								<i class="fa fa-user" aria-hidden="true"></i>
								<strong><?php echo $objValue->user_name; ?></strong>
								<span class="text-muted pull-right"><?php echo $objValue->created_at; ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		<?php } ?>
		<?php if (!$blnCheck) {echo '<div class="col-xs-12"><i>No records found.</i></div>';} ?>
	</div>
	<!-- END COMMENTS RECIEVED -->

	<h4 class="page-header">Comments Given</h4>
	<div class="row">
		<?php $blnCheck = false; ?>
		<?php foreach ($objData->comments['given'] as $intImageId => $arrComments) { ?>
			<?php $blnCheck = empty($arrComments) ? false : true; ?>
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-2">
						<a data-toggle="modal" data-target="#imageModal" data-image="<?php echo $arrComments->image_id; ?>">
					    <div class="thumbnail">
					        <img class="img-responsive user-photo" src="<?php echo '\public\uploads\show_tell\\' . $arrComments->resource; ?>">
					    	<div class="caption">
								<?php echo $arrComments->image_name; ?>
							</div>
					    </div>
						</a>
					</div>

					<div class="col-sm-10">
					    <div class="panel panel-default">
					        <div class="panel-body">
					            <?php echo $arrComments->text; ?>
					        </div>
					        <div class="panel-footer">
					        	<i class="fa fa-user" aria-hidden="true"></i>
					            <strong><?php echo $arrComments->user_name; ?></strong>
					            <span class="text-muted pull-right"><?php echo $arrComments->created_at; ?></span>
					        </div>
					    </div>
					</div>
				</div>
			</div>
		<?php } ?>
		<?php if (!$blnCheck) {echo '<div class="col-xs-12"><i>No records found.</i></div>';} ?>
	</div>
	<!-- END COMMENTS GIVEN -->

</div>
