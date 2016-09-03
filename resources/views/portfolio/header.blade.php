<nav class="navbar navbar-inverse navbar-fixed-top" id="portfolio-header">
    <div class="container">
        <div class="navbar-header">
            <span class="navbar-brand">
                <a href="/">Sthenos</a>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                <a href="/#portfolio">Portfolio</a>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                {{ $arrData['label'] }}
            </span>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown" id="portfolio-info">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-question" aria-hidden="true"></i>
                </a>
                <ul class="dropdown-menu">
                    <p>{{ $arrData['info'] }}</p>
                    <li role="separator" class="divider"></li>
                    <li><a href="{{ $arrData['repo'] }}" target="_blank">View Repository</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>