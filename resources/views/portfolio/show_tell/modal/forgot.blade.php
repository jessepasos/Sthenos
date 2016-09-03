
<div class="modal fade" id="forgotModal" tabindex="-1" role="dialog" aria-labelledby="forgotModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form method="POST" action="/show_tell/reset">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="email@example.com" name="email" type="text">
                        </div>

                        <input class="btn btn btn-success btn-block" type="submit" name="action" value="Reset Password">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
