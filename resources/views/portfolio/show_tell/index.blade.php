@extends('layout.portfolio')
@section('title', 'Show and Tell')

@extends('portfolio.header')



@section('content')



<div class="show-tell">

@include('portfolio.show_tell.modal.login')
@include('portfolio.show_tell.modal.image')
@include('portfolio.show_tell.modal.profile')
@include('portfolio.show_tell.modal.forgot')
<?php if(session('alert')) { $objData->alert = session('alert'); }?>

    <div class="jumbotron" id="header-image">
        <div class="container">
            <h1>Show and Tell</h1>
        </div>
    </div>

    <div class="container">

        @include('portfolio.show_tell.alert')

        <div class="row">
            <?php if (!Auth::check()) {?>
            <div class="col-xs-12 col-md-12">
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#loginModal">Login</button>
            </div>
            <?php }?>
            <?php if (Auth::check()) {?>
            <div class="col-lg-5">
                <div class="media">
                    <a class="pull-left" href="#">
                        <img src="<?php echo $objData->user['gravatar']['sm']; ?>" class="img-circle">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $objData->user['name']; ?> <small><?php echo ucfirst($objData->user['role']); ?></small></h4>
                        <h5><?php echo $objData->user['email']; ?></h5>
                        <a href="/show_tell/dashboard"><span class="label label-success">Dashboard</span></a>
                        <a href="/show_tell/logout"><span class="label label-default">Logout</span></a>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
        <hr>

        <div class="row">
            <?php foreach ($objFrontPage->items as $intKey => $objValue) {?>
            <div class="col-xs-6 col-md-3">
                <div class="thumbnail">
                    <a data-toggle="modal" data-target="#imageModal" data-image="<?php echo $objValue->id; ?>">
                        <img src="<?php echo '\public\uploads\show_tell\\' . $objValue->resource; ?>" class="img-rounded">
                    </a>
                    <div class="caption">
                        <ul class="list-inline">
                            <li class="pull-right"><a data-toggle="modal" data-target="#imageModal" data-dismiss="modal" data-image="<?php echo $objValue->id; ?>"><i class="fa fa-comment font-icon" aria-hidden="true"></i></a></li>
                            <li class="pull-right"><a data-toggle="modal" data-target="#profileModal" data-dismiss="modal" data-user="<?php echo $objValue->user_id; ?>"><i class="fa fa-user font-icon" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
        <hr>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/js/portfolio/show_tell.js') }}"></script>

@endsection
