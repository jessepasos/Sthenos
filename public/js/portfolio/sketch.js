jQuery( document ).ready( function( $ ) {


    /**
     * [Sketch_Pad description]
     */
    Sketch_Pad = function() {
        this.init();
    }

    /**
     * [prototype description]
     */
    $.extend( Sketch_Pad.prototype, {

        objCanvas: {},

        /**
         * [init description]
         */
        init: function() {

            var objThis = this;

            this.objCanvas = {
                draw: document.getElementById( "draw-canvas" ),
                action: {
                    save: document.getElementById( 'draw-save' ),
                    clear: document.getElementById( 'draw-clear' ),
                },
                brush: {
                    color: '#000000',
                    size: '5',
                },
            };

            if ( this.objCanvas.draw ) {
                this.drawCanvas();
            }

            $( 'body' ).on( 'click', '.colour-selection', function() {

                $( '.colour-selection' ).removeClass( 'active' );
                $( this ).addClass( 'active' );
                $( '.js_colourIcon' ).css( 'color', $( this ).data( 'colour' ) );

                objThis.objCanvas.brush.color = $( this ).data( 'colour' );
            } );

            $( 'body' ).on( 'click', '.size-selection', function() {

                $( '.size-selection' ).removeClass( 'active' );
                $( this ).addClass( 'active' );

                objThis.objCanvas.brush.size = $( this ).data( 'size' );
            } );

            $( 'body' ).on( 'click', '#draw-clear', function() {
                objThis.clearCanvas();
            } );

            this.objCanvas.action.save.addEventListener( 'click', function( event ) {
                objThis.saveCanvas();
            } );
        },

        /**
         * [drawCanvas description]
         */
        drawCanvas: function() {

            var blnPenDown = false;
            var context = this.objCanvas.draw.getContext( "2d" );
            var positionX, positionY;
            var objThis = this;

            context.lineWidth = this.objCanvas.brush.size;

            $( this.objCanvas.draw )
                .mousedown( function( event ) {
                    blnPenDown = true;

                    context.beginPath();

                    positionX = event.pageX - this.offsetLeft;
                    positionY = event.pageY - this.offsetTop;

                    context.moveTo( positionX, positionY );
                } )
                .mousemove( function( event ) {

                    if ( blnPenDown ) {
                        positionX = event.pageX - this.offsetLeft;
                        positionY = event.pageY - this.offsetTop;
                        context.lineTo( positionX, positionY );
                        context.strokeStyle = objThis.objCanvas.brush.color;
                        context.lineWidth = objThis.objCanvas.brush.size;
                        context.stroke();
                    }
                } )
                .mouseup( function( event ) {
                    blnPenDown = false;
                    context.closePath();
                } );
        },

        /**
         * [saveCanvas description]
         */
        saveCanvas: function() {

            this.objCanvas.action.save.href = this.objCanvas.draw.toDataURL( 'image/png' );

        },

        /**
         * [clearCanvas description]
         */
        clearCanvas: function() {

            var context = this.objCanvas.draw.getContext( "2d" );
            context.clearRect( 0, 0, this.objCanvas.draw.width, this.objCanvas.draw.height );
        },
    } );

    new Sketch_Pad();
} );