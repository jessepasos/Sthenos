<div class="row tab-row">

    <h4 class="page-header">Pending Images</h4>
    <div class="row">
        <?php if(count($objData->album['pending']) == 0) { ?>
        <div class="col-xs-12">
            <i>No records found.</i>
        </div>
        <?php } ?>
        <?php foreach($objData->album['pending'] as $intKey => $objValue) { ?>
            <div class="col-xs-6 col-md-3" id="js_imageId_<?php echo $objValue->id; ?>">
                <div class="thumbnail">
                    <a data-toggle="modal" data-target="#imageModal" data-image="<?php echo $objValue->id; ?>">
                        <img src="<?php echo '\public\uploads\show_tell\\' . $objValue->resource; ?>" class="img-rounded">
                    </a>
                    <div class="caption">
                        <ul class="list-inline">
                            <li><?php echo $objValue->name; ?></li>
                            <li class="pull-right"><a data-toggle="modal" data-target="#removeModal" data-id="<?php echo $objValue->id; ?>"><i class="fa fa-times font-icon" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>

    <h4 class="page-header">Submitted Images</h4>
    <div class="row">
        <?php if(count($objData->album['uploads']) == 0) { ?>
        <div class="col-xs-12">
            <i>No records found.</i>
        </div>
        <?php } ?>
        <?php foreach($objData->album['uploads'] as $intKey => $objValue) { ?>
            <div class="col-xs-6 col-md-3" id="js_imageId_<?php echo $objValue->id; ?>">
                <div class="thumbnail">
                    <a data-toggle="modal" data-target="#imageModal" data-image="<?php echo $objValue->id; ?>">
                        <img src="<?php echo '\public\uploads\show_tell\\' . $objValue->resource; ?>" class="img-rounded">
                    </a>
                    <div class="caption">
                        <ul class="list-inline">
                            <li><?php echo $objValue->name; ?></li>
                            <li class="pull-right"><a data-toggle="modal" data-target="#removeModal" data-id="<?php echo $objValue->id; ?>"><i class="fa fa-times font-icon" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php }?>
    </div>
</div>
