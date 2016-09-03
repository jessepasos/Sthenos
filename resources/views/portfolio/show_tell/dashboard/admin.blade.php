
<div class="row tab-row">
    <h4 class="page-header">Pending Images</h4>
    <div class="row">
        <div class="col-xs-12">
            <?php if(empty($objData->admin['images'])) { ?>
                <i>No records found.</i>
            <?php } ?>
            <ul class="list-group">
                <?php foreach($objData->admin['images'] as $objImages) { ?>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-1">
                            <a data-toggle="modal" data-target="#imageModal" data-image="<?php echo $objImages->id; ?>">
                                <span class='btn btn-info btn-sm'><i class="fa fa-eye font-icon" aria-hidden="true"></i></span>
                            </a>
                        </div>
                        <div class="col-sm-5"> <?php echo $objImages->name; ?></div>
                        <div class="col-sm-4">
                            <a data-toggle="modal" data-target="#profileModal" data-user="<?php echo $objImages->id; ?>">
                                <i class="fa fa-user font-icon" aria-hidden="true"></i> <?php echo $objImages->username; ?>
                            </a>
                        </div>
                        <div class="col-sm-1">
                            <a href="/show_tell/image_accept/<?php echo $objImages->id; ?>">
                                <span class='btn btn-primary btn-sm'><i class="fa fa-check-circle font-icon" aria-hidden="true"></i></span>
                            </a>
                        </div>
                        <div class="col-sm-1">
                            <a href="/show_tell/image_deny/<?php echo $objImages->id; ?>">
                                <span class='btn btn-danger btn-sm'><i class="fa fa-times-circle font-icon" aria-hidden="true"></i></span>
                            </a>
                        </div>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <h4 class="page-header">View Users</h4>
    <div class="row">
        <div class="col-xs-12">
            <ul class="list-group">
                <?php foreach($objData->admin['users'] as $objUsers) { ?>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-5"><?php echo $objUsers->name; ?></div>
                        <div class="col-sm-5"><?php echo $objUsers->email; ?></div>
                        <div class="col-sm-2"><?php echo ucfirst($objUsers->role); ?></div>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
