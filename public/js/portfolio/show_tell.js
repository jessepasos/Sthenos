jQuery( document ).ready( function( $ ) {

    /**
     * @func     func_name
     * @desc     description
     * @param    {[type]}       intImageId    [description]
     */
    Remove_Image = function( intImageId ) {
        this.init( intImageId );
    }

    /**
     * @func      func_name
     * @desc      description
     */
    $.extend( Remove_Image.prototype, {

        intUserId: 0,

        /**
         * @func      func_name
         * @desc      description
         * @param     {[type]}       intImageId    [description]
         * @return    {[type]}                     [description]
         */
        init: function( intImageId ) {

            var objParent = this;

            this.intUserId = intImageId;

            $( 'body' ).on( 'click', '#js_removeImage', function() {
                objParent.ajax_removeImage();
            } );

        },

        /**
         * @func      ajax_removeImage
         * @desc      description
         */
        ajax_removeImage: function() {

            $.ajax( {
                url: '/show_tell/ajax_removeImage',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $( 'input[name=_token]' ).val()
                },
                type: 'POST',
                dataType: 'json',
                data: {
                    id: this.intUserId
                },
                success: function( objResponse ) {

                    $( '#removeModal' ).modal( 'hide' );
                    location.reload();
                },
                error: function( objError ) {
                    console.log( objError );
                }
            } );
        },
    } );

    /**
     * @func      func_name
     * @desc      description
     */
    $( '#removeModal' ).on( 'show.bs.modal', function( event ) {
        new Remove_Image( $( event.relatedTarget ).data( 'id' ) );
    } );


    /**
     * [Sketch_Pad description]
     */
    View_User = function( intUserId ) {
        this.init( intUserId );
    }

    /**
     * [prototype description]
     */
    $.extend( View_User.prototype, {

        intUserId: 0,

        /**
         * [init description]
         */
        init: function( intUserId ) {

            $( '#imageModal' ).modal( 'hide' );

            this.intUserId = intUserId;
            this.ajax_getUserData();

            $( 'body' ).addClass( 'modal-open' );
            $( 'body' ).attr( 'style', '' );
        },

        /**
         * @func      ajax_getUserData
         * @desc      description
         */
        ajax_getUserData: function() {

            $.ajax( {
                url: '/show_tell/ajax_getUserData',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $( 'input[name=_token]' ).val()
                },
                type: 'POST',
                dataType: 'json',
                data: {
                    id: this.intUserId
                },
                success: function( objResponse ) {

                    var objUser = objResponse[ 0 ][ 'user' ];
                    var objStatus = objResponse[ 0 ][ 'status' ];

                    $( '#js_userGrav' ).html( '<img src="' + objUser[ 'gravatar' ] + '" class="img-rounded">' );
                    $( '#js_userName' ).html( objUser[ 'name' ] );
                    $( '#js_userRole' ).html( objUser[ 'role' ] );
                    $( '#js_userEmail' ).html( objUser[ 'email' ] );
                    $( '#js_userUploads' ).html( objStatus[ 'uploads' ] );
                    $( '#js_userGiven' ).html( objStatus[ 'given' ] );
                    $( '#js_userReceived' ).html( 'x' );

                    var strHtml = '';
                    var arrImages = objResponse[ 0 ][ 'images' ];
                    for ( var intIndex in arrImages ) {
                        strHtml += '<div class="col-xs-6 col-md-3">';
                        strHtml += '    <div class="thumbnail">';
                        strHtml += '        <a data-toggle="modal" data-target="#imageModal" data-dismiss="modal" data-image="' + arrImages[ intIndex ][ 'id' ] + '">';
                        strHtml += '            <img src="\\public\\uploads\\show_tell\\' + arrImages[ intIndex ][ 'resource' ] + '" class="img-rounded">';
                        strHtml += '        </a>';
                        strHtml += '    </div>';
                        strHtml += '</div>';
                    }

                    $( '#js_userImages' ).html( strHtml );

                },
                error: function( objError ) {
                    console.log( objError );
                }
            } );

        },
    } );

    $( '#profileModal' ).on( 'shown.bs.modal', function( event ) {
        new View_User( $( event.relatedTarget ).data( 'user' ) );
    } );





    /**
     * [Sketch_Pad description]
     */
    View_Image = function( intImageId ) {
        this.init( intImageId );
    }

    /**
     * [prototype description]
     */
    $.extend( View_Image.prototype, {

        intImageId: 0,

        /**
         * [init description]
         */
        init: function( intImageId ) {

            $( '#profileModal' ).modal( 'hide' );

            this.intImageId = intImageId;
            this.ajax_getImageData();

            $( '#js_commentText' ).val( '' );
            $( '#js_imageComments' ).html( '' );


            $( 'body' ).addClass( 'modal-open' );
            $( 'body' ).attr( 'style', '' );
        },

        /**
         * @func      ajax_getImageData
         * @desc      description
         */
        ajax_getImageData: function() {

            $.ajax( {
                url: '/show_tell/ajax_getImageData',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $( 'input[name=_token]' ).val()
                },
                type: 'POST',
                dataType: 'json',
                data: {
                    id: this.intImageId
                },
                success: function( objResponse ) {

                    var arrImage = objResponse[ 0 ][ 'image' ][ 0 ];
                    var arrComment = objResponse[ 0 ][ 'comments' ];
                    var arrUser = objResponse[ 0 ][ 'user' ];

                    // Show header data:
                    $( '#js_imageTitle' ).html( arrImage[ 'name' ] );
                    $( '#js_imageUserId' ).attr( 'data-user', arrUser[ 'id' ] );
                    $( '#js_imageUserName' ).html( arrUser[ 'name' ] );

                    // Show image:
                    $( '#js_imageShow' ).html( '<img src="\\public\\uploads\\show_tell\\' + arrImage[ 'resource' ] + '" class="img-rounded">' );

                    // Set comments:
                    var strHtml = '';
                    for ( var intIndex in arrComment ) {

                        var arrThisComment = arrComment[ intIndex ];

                        strHtml += '<div class="col-sm-12">';
                        strHtml += '    <div class="row">';
                        strHtml += '        <div class="col-sm-2">';
                        strHtml += '            <div class="thumbnail">';
                        strHtml += '                <a id="js_imageUserId" data-toggle="modal" data-target="#profileModal" data-user="' + arrThisComment[ 'user_id' ] + '">';
                        strHtml += '                    <img class="img-responsive user-photo" src="' + arrThisComment[ 'gravatar' ] + '">';
                        strHtml += '                </a>';
                        strHtml += '            </div>';
                        strHtml += '        </div>';
                        strHtml += '        <div class="col-sm-10">';
                        strHtml += '            <div class="panel panel-default">';
                        strHtml += '                <div class="panel-body">';
                        strHtml += arrThisComment[ 'text' ];
                        strHtml += '                </div>';
                        strHtml += '                <div class="panel-footer">';
                        strHtml += '                    <a id="js_imageUserId" data-toggle="modal" data-target="#profileModal" data-user="' + arrThisComment[ 'user_id' ] + '">';
                        strHtml += '                        <i class="fa fa-user" aria-hidden="true"></i> ';
                        strHtml += '                        <strong>' + arrThisComment[ 'name' ] + '</strong>';
                        strHtml += '                    </a>';
                        strHtml += '                     <span class="text-muted pull-right">' + arrThisComment[ 'created_at' ] + '</span>';
                        strHtml += '                </div>';
                        strHtml += '            </div>';
                        strHtml += '        </div>';
                        strHtml += '    </div>';
                        strHtml += '</div>';
                    }

                    // Display comments:
                    $( '#js_imageComments' ).append( strHtml );

                    // Set image id to the comment submit:
                    $( '#js_commentSubmit' ).attr( 'data-image', arrImage[ 'id' ] );

                },
                error: function( objError ) {
                    console.log( objError );
                }
            } );

        },
    } );


    $( '#imageModal' ).on( 'shown.bs.modal', function( event ) {
        new View_Image( $( event.relatedTarget ).data( 'image' ) );
    } );


    Submit_Comment = function( intUserId, intImageId ) {
        this.init( intUserId, intImageId );
    }

    /**
     * [prototype description]
     */
    $.extend( Submit_Comment.prototype, {

        intUserId: 0,
        intImageId: 0,

        /**
         * [init description]
         */
        init: function( intUserId, intImageId ) {

            this.intUserId = intUserId;
            this.intImageId = intImageId;
            this.ajax_submitComment();

            $( '#js_commentText' ).val( '' );
        },

        /**
         * @func      ajax_submitComment
         * @desc      description
         */
        ajax_submitComment: function() {

            $.ajax( {
                url: '/show_tell/ajax_submitComment',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $( 'input[name=_token]' ).val()
                },
                type: 'POST',
                dataType: 'json',
                data: {
                    user: this.intUserId,
                    image: this.intImageId,
                    comment: $( '#js_commentText' ).val()
                },
                success: function( objResponse ) {

                    $( '#js_commentText' ).val( '' );

                    var arrComment = objResponse[ 0 ][ 'comment' ];
                    var arrUser = objResponse[ 0 ][ 'user' ];
                    var strGravatar = objResponse[ 0 ][ 'gravatar' ];
                    var strDate = objResponse[ 0 ][ 'created_at' ];

                    var strHtml = '<div class="col-sm-12">';
                    strHtml += '    <div class="row">';
                    strHtml += '        <div class="col-sm-2">';
                    strHtml += '            <div class="thumbnail">';
                    strHtml += '                <a id="js_imageUserId" data-toggle="modal" data-target="#profileModal" data-user="' + arrUser[ 'user_id' ] + '">';
                    strHtml += '                    <img class="img-responsive user-photo" src="' + strGravatar + '">';
                    strHtml += '                </a>';
                    strHtml += '            </div>';
                    strHtml += '        </div>';
                    strHtml += '        <div class="col-sm-10">';
                    strHtml += '            <div class="panel panel-default">';
                    strHtml += '                <div class="panel-body">';
                    strHtml += arrComment[ 'text' ];
                    strHtml += '                </div>';
                    strHtml += '                <div class="panel-footer">';
                    strHtml += '                    <a id="js_imageUserId" data-toggle="modal" data-target="#profileModal" data-user="' + arrUser[ 'user_id' ] + '">';
                    strHtml += '                        <i class="fa fa-user" aria-hidden="true"></i> ';
                    strHtml += '                        <strong>' + arrUser[ 'name' ] + '</strong>';
                    strHtml += '                    </a>';
                    strHtml += '                     <span class="text-muted pull-right">' + strDate + '</span>';
                    strHtml += '                </div>';
                    strHtml += '            </div>';
                    strHtml += '        </div>';
                    strHtml += '    </div>';
                    strHtml += '</div>';

                    $( '#js_imageComments' ).append( strHtml );

                },
                error: function( objError ) {
                    console.log( objError );
                }
            } );

        },
    } );

    $( 'body' ).on( 'click', '#js_commentSubmit', function() {
        new Submit_Comment( $( this ).data( 'user' ), $( this ).data( 'image' ) );
    } );
} );