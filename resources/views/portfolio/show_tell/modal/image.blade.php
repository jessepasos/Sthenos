
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h3>
                    <span id="js_imageTitle"></span>
                    <small>
                        <a id="js_imageUserId" data-toggle="modal" data-target="#profileModal" data-user="0">
                            <i class="fa fa-user" aria-hidden="true"></i> <span id="js_imageUserName"></span>
                        </a>
                    </small>
                    <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </h3>
             </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="thumbnail" id="js_imageShow">
                        </div>
                    </div>
                </div>

                <div class="row" id="js_imageComments"></div>

                <?php if (Auth::check()) {?>
                <div class="row">
                    <div class="col-sm-12">

                        <div class="row">
                            <div class="col-sm-2">
                                <div class="thumbnail">
                                    <img class="img-responsive" src="<?php echo $objData->user['gravatar']['sm']; ?>">
                                </div>
                            </div>
                            <form action="POST">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <div class="col-sm-10">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                             <textarea class="form-control" id="js_commentText"></textarea>
                                        </div>
                                        <div class="panel-footer">
                                            <span class="btn btn-primary btn-block" id="js_commentSubmit" data-user="<?php echo $objData->user['id']; ?>">Submit</span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>