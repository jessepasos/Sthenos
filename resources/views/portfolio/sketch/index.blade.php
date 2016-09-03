

@extends('layout.portfolio')
@section('title', 'Sketch')

@extends('portfolio.header')

@section('content')
<div class="sketch-body">
	<div class="container container-sketch">
		<nav>
			<ul class="nav nav-tabs">
				<li role="presentation" class="brand">
					<a href="#">Sketch!</a>
				</li>
				<li role="presentation" class="dropdown">
				    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
				      	<i class="fa fa-paint-brush js_colourIcon" aria-hidden="true"></i>
				    </a>
				    <ul class="dropdown-menu">
					    <li>
					    	<div class="row">
								<?php foreach ($arrData['options']['colours'] as $strHex => $strName) {?>
								<div class="col-sm-4">
									<span class="btn btn-default btn-block colour-selection" data-colour="<?php echo $strHex; ?>" style="background:<?php echo $strHex; ?>;"></span>
								</div>
								<?php }?>
							</div>
					    </li>
					</ul>
		  		</li>
		  		<li role="presentation" class="dropdown">
				    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
				      	<i class="fa fa-arrows" aria-hidden="true"></i>
				    </a>
				    <ul class="dropdown-menu">
					    <li>
				    		<div class="row">
								<?php foreach ($arrData['options']['sizes'] as $strSize => $strName) {?>
								<div class="col-sm-12">
									<span class="btn btn-default btn-block size-selection" data-size="<?php echo $strSize; ?>"><?php echo $strName; ?></span>
								</div>
								<?php }?>
							</div>
					    </li>
					</ul>
		  		</li>

				<li role="presentation">
					<a href="#" id="draw-clear">
						<i class="fa fa-file-o" aria-hidden="true"></i>
					</a>
				</li>

				<li role="presentation">
					<a href="#" id="draw-save" download="sketch.png">
						<i class="fa fa-floppy-o" aria-hidden="true"></i>
					</a>
				</li>
			</ul>
		</nav>

		<div class="row">
			<canvas id="draw-canvas" width="575" height="500">
				Opps. Look's like your browser doesn't support canvas.
			</canvas>
		</div>
	</div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/js/portfolio/sketch.js') }}"></script>

@endsection
