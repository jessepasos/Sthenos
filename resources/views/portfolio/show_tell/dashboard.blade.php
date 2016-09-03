@extends('layout.portfolio')
@section('title', 'Show and Tell')

@extends('portfolio.header')

@section('content')


<div class="show-tell">


@include('portfolio.show_tell.modal.remove')
@include('portfolio.show_tell.modal.image')
@include('portfolio.show_tell.modal.profile')

<?php if(session('dashboard')) { $objData->dashboard = session('dashboard'); }?>
<?php if(session('alert')) { $objData->alert = session('alert'); }?>

    <div class="jumbotron" id="header-image">
        <div class="container">
            <h1>Show and Tell</h1>
        </div>
    </div>

    <div class="container">

		<ol class="breadcrumb">
			<li><a href="/show_tell">Home</a></li>
			<li class="active">Dashboard</li>
		</ol>

        @include('portfolio.show_tell.alert')

        <div class="row">
        	<div class="col-sm-3">
        		<div class="thumbnail">
                    <img src="<?php echo $objData->user['gravatar']['lg']; ?>" class="img-rounded">
                </div>

                <hr>

    			<ul class="list-unstyled">
					<li><h4><?php echo $objData->user['name']; ?></h4></li>
					<li><?php echo $objData->user['email']; ?></li>
				</ul>

				<hr>

				<ul class="list-group">
					<li class="list-group-item">Level <span class="pull-right"><?php echo ucfirst($objData->user['role']); ?></span></li>
					<li class="list-group-item">Status <span class="pull-right"><?php echo $objData->user['status']; ?></span></li>
					<li class="list-group-item">Uploads <span class="pull-right"><?php echo $objData->status['uploads']; ?></span></li>
					<li class="list-group-item">Pending Uploads <span class="pull-right"><?php echo $objData->status['pending']; ?></span></li>
					<li class="list-group-item">Comments Recieved <span class="pull-right"><?php echo $objData->status['recieved']; ?></span></li>
					<li class="list-group-item">Comments Given <span class="pull-right"><?php echo $objData->status['given']; ?></span></li>
				</ul>
        	</div>

        	<div class="col-sm-9">

				<div>
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="<?php if($objData->dashboard == 'dashboard') { echo 'active'; } ?>"><a href="#album" aria-controls="album" role="tab" data-toggle="tab">Album</a></li>
						<li role="presentation" class="<?php if($objData->dashboard == 'comment') { echo 'active'; } ?>"><a href="#comment" aria-controls="comment" role="tab" data-toggle="tab">Comments</a></li>
						<li role="presentation" class="<?php if($objData->dashboard == 'profile') { echo 'active'; } ?>"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
						<li role="presentation" class="<?php if($objData->dashboard == 'submit') { echo 'active'; } ?>"><a href="#submit" aria-controls="submit" role="tab" data-toggle="tab">Upload</a></li>
						<?php if($objData->is_admin) { ?>
						<li role="presentation" class="<?php if($objData->dashboard == 'admin') { echo 'active'; } ?>"><a href="#admin" aria-controls="admin" role="tab" data-toggle="tab">Admin</a></li>
						<?php } ?>
					</ul>

					<div class="tab-content">
						<div role="tabpanel" class="tab-pane <?php if($objData->dashboard == 'dashboard') { echo 'active'; } ?>" id="album">

							@include('portfolio.show_tell.dashboard.album')

						</div>
						<div role="tabpanel" class="tab-pane <?php if($objData->dashboard == 'comment') { echo 'active'; } ?>" id="comment">

							@include('portfolio.show_tell.dashboard.comment')

						</div>
						<div role="tabpanel" class="tab-pane <?php if($objData->dashboard == 'profile') { echo 'active'; } ?>" id="profile">

							@include('portfolio.show_tell.dashboard.user')

						</div>
						<div role="tabpanel" class="tab-pane <?php if($objData->dashboard == 'submit') { echo 'active'; } ?>" id="submit">

							@include('portfolio.show_tell.dashboard.submit')

						</div>
						<?php if($objData->is_admin) { ?>
						<div role="tabpanel" class="tab-pane <?php if($objData->dashboard == 'admin') { echo 'active'; } ?>" id="admin">

							@include('portfolio.show_tell.dashboard.admin')

						</div>
						<?php } ?>
					</div>

				</div>
        	</div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/js/portfolio/show_tell.js') }}"></script>

@endsection
