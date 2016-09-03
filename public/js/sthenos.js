// * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
//  @desc   Close menu on click
//
// * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
$( "body" ).on( "click", ".menu-close", function( event ) {
    event.preventDefault();
    $( "#sidebar-wrapper" ).toggleClass( "active" );

} );


// * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
//  @desc   Toggle menu on click
//
// * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
$( "body" ).on( "click", ".menu-toggle", function( event ) {
    event.preventDefault();
    $( "#sidebar-wrapper" ).toggleClass( "active" );

} );


// Scrolls to the selected menu item on the page
$( function() {
    $( 'a[href*="#"]:not([href="#"])' ).click( function() {
        if ( location.pathname.replace( /^\//, '' ) == this.pathname.replace( /^\//, '' ) || location.hostname == this.hostname ) {
            var target = $( this.hash );
            target = target.length ? target : $( '[name=' + this.hash.slice( 1 ) + ']' );
            if ( target.length ) {
                $( 'html,body' ).animate( {
                    scrollTop: target.offset().top
                }, 1000 );
                return false;
            }
        }
    } );
} );
//#to-top button appears after scrolling
var fixed = false;
$( document ).scroll( function() {
    if ( $( this ).scrollTop() > 250 ) {
        if ( !fixed ) {
            fixed = true;
            // $('#to-top').css({position:'fixed', display:'block'});
            $( '#to-top' ).show( "slow", function() {
                $( '#to-top' ).css( {
                    position: 'fixed',
                    display: 'block'
                } );
            } );
        }
    }
    else {
        if ( fixed ) {
            fixed = false;
            $( '#to-top' ).hide( "slow", function() {
                $( '#to-top' ).css( {
                    display: 'none'
                } );
            } );
        }
    }
} );



/**
 * @func     func_name
 * @desc     description
 * @param    {[type]}       intImageId    [description]
 */
Portfolio = function() {
    this.init();
}

/**
 * @func      func_name
 * @desc      description
 */
$.extend( Portfolio.prototype, {

    objData: {},
    strActive: '',

    /**
     * @func      func_name
     * @desc      description
     * @param     {[type]}       intImageId    [description]
     * @return    {[type]}                     [description]
     */
    init: function( intImageId ) {

        this.objData = {
            sketch: {
                label: 'Sketch',
                info: 'A sketch-pad built using the HTML canvas element. The user can select brush colour and sizes, and download their finished image.',
                repo: 'https://github.com/jessepasos/Sketch',
                demo: 'http://www.sthenos.net/portfolio/sketch',
                image: 'http://www.sthenos.net/public/images/protfolio_sketch.png',
                tools: [ 'Javascript and JQuery', 'PHP', 'Ajax', 'Bootstrap', 'SASS', 'Laravel' ],
            },
            show_tell: {
                label: 'Show and Tell',
                info: 'An social image uploader built in Laravel. Show and Tell lets up share your images with other users, and give and receive comments.',
                repo: 'https://github.com/jessepasos',
                demo: 'http://www.sthenos.net/show_tell',
                image: 'http://www.sthenos.net/public/images/portfolio_show_tell.png',
                tools: [ 'Javascript and JQuery', 'PHP', 'Ajax', 'Bootstrap', 'SASS', 'Laravel' ],
            },
            stopwatch: {
                label: 'Stopwatch',
                info: 'A stopwatch application built with Java.',
                repo: 'https://github.com/jessepasos/Stopwatch',
                demo: 'https://github.com/jessepasos/Stopwatch',
                image: 'http://www.sthenos.net/public/images/portfolio_stopwatch.png',
                tools: [ 'Java', 'Eclipse' ],
            },
            convert: {
                label: 'Unit Converter',
                info: 'A unit-converter application built with Java.',
                repo: 'https://github.com/jessepasos/Converter',
                demo: 'https://github.com/jessepasos/Converter',
                image: 'http://www.sthenos.net/public/images/portfolio_converter.png',
                tools: [ 'Java', 'Eclipse' ],
            },
            // sthenos: {
            //     label: 'Sthenos',
            //     info: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            //     repo: 'https://github.com/jessepasos',
            //     demo: 'http://www.sthenos.net/',
            //     image: 'http://placehold.it/500x500',
            //     tools: [ 'a', 'b', 'c', 'd' ],
            // },
            // blog: {
            //     label: 'Laravel Blog',
            //     info: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            //     repo: 'https://github.com/jessepasos',
            //     demo: 'http://www.sthenos.net/',
            //     image: 'http://placehold.it/500x500',
            //     tools: [ 'a', 'b', 'c', 'd' ],
            // },
        };

        this.strActive = 'sketch';

        this.renderOnLoad();

        var objThis = this;
        $( 'body' ).on( 'click', '.js_folioItem', function() {

            $( '.js_folioItem' ).removeClass( 'active' );
            $( this ).addClass( 'active' );

            objThis.strActive = $( this ).data( 'key' );
            objThis.renderInfo();
        } );
    },

    renderOnLoad: function() {

        this.renderInfo();

        var strHtml = '';
        var objFolioItems = this.objData;
        for ( var strIndex in objFolioItems ) {
            strHtml += '<div class="col-xs-6 col-md-3">';
            strHtml += '<a class="thumbnail js_folioItem" data-key="' + strIndex + '">';
            strHtml += '<img src="' + objFolioItems[ strIndex ].image + '">';
            strHtml += '</a>';
            strHtml += '</div>';
        }
        $( '#js_folioItems' ).html( strHtml );
    },

    renderInfo: function() {

        var arrKey = this.objData[ this.strActive ];

        var strHtml = '';
        for ( var intIndex in arrKey.tools ) {
            strHtml += '<li>' + arrKey.tools[ intIndex ] + '</li>';
        }

        $( '#js_folioBody' ).fadeOut( "slow", function() {
            $( '#js_folioTitle' ).html( arrKey.label );
            $( '#js_folioInfo' ).html( arrKey.info );
            $( '#js_folioTools' ).html( strHtml );
            $( '#js_folioBody' ).fadeIn( "slow" );
        } );

        $( '#js_folioDemo' ).attr( 'href', arrKey.demo );
        $( '#js_folioSource' ).attr( 'href', arrKey.repo );
    },
} );

new Portfolio();