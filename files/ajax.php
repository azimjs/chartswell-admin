<?php
/**
 * Created by PhpStorm.
 * User: Azim
 * Date: 12/13/2015
 * Time: 12:56 AM
 */
include('global.php');
use Parse\ParseQuery;

$class = $_GET['class'];
$objectId = $_GET['objectId'];
$name = $_GET['name'];
$query = new ParseQuery($class);
try {
    $object = $query->get($objectId);
    // The object was retrieved successfully.
//    print_r($object);
} catch (ParseException $ex) {
    // The object was not retrieved successfully.
    // error is a ParseException with an error code and message.
}
?>
<body>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Edit <?php echo $class;?></h4>
</div>
<div class="modal-body">
        <div class="panel-body">
            <div class="row">
                <div id="formNotification"></div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <form action="" method="post" role="form" enctype="multipart/form-data" id="brand_form">
                        <div class="form-group">
                            <label>Brand Name</label>
                            <input class="form-control" name="brand_name" placeholder="Brand Name" value="">
                            <p class="help-block">Enter the Brand's Name.</p>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Multiplier</label>
                            <input type="number" class="form-control" name="brand_multiplier" placeholder="Brand Multiplier">
                            <p class="help-block">Enter the Brand's Multiplier.</p>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Location</label>
                            <input class="form-control" name="brand_location" placeholder="Location">
                            <p class="help-block">Enter the Brand's location.</p>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="brand_description" id="" style="width:100%" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Brand Image</label>
                            <input type="file" name="brand_image">
                        </div>

                        <button type="submit" name="submit_brand" class="btn btn-primary btn-lg btn-block">Submit</button>
                        <button type="reset" class="btn btn-outline btn-primary btn-lg btn-block">Reset Button</button>
                    </form>
                </div>
                <!-- /.col-lg-6 (nested) -->
            </div>
            <!-- /.row (nested) -->
        </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary">Save changes</button>
</div>
</body>