

<?php if (count($errors) > 0) { ?>
    <div class="alert alert-danger">
        There were some problems with your input:
        <ul>
            <?php 
            foreach ($errors->all() as $error) {
                echo '<li>' . $error . '</li>';
            } 
            ?>
        </ul>
    </div>
<?php } ?>

<?php if($objData->alert) { ?>
<div class="alert alert-<?php echo$objData->alert['status']; ?>" alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong><?php echo $objData->alert['heading']; ?></strong>
    <?php echo $objData->alert['message']; ?>
</div>
<?php } ?>
