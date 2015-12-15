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
$type = $_GET['type'];
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

if($class="Brand" && $type = "edit") {
    ?>
    <script type="text/javascript">
        $("#save_changes").click(function(){
            var Brand = Parse.Object.extend("Brand");
            var query = new Parse.Query(Brand);

            var objectId = $("#brand_objectId").val().toString();
            var name = $("#brand_name").val().toString();
            var multiplier = parseInt($("#brand_multiplier").val());
            var location = $("#brand_location").val().toString();
            var description = $("#brand_description").html().toString().trim();

            console.log(objectId);

            query.get(objectId, {
                success: function(brandObj) {
                    // The object was retrieved successfully.
                    console.log("sucess");
                    brandObj.set("name", name);
                    brandObj.set("multiplier", multiplier);
                    brandObj.set("location", location);
                    brandObj.set("description", description);

                    var fileUploadControl = $("#brand_image")[0];
                    if (fileUploadControl.files.length > 0) {
                        var file = fileUploadControl.files[0];
                        var file_name = fileUploadControl.value.split('/').pop().split('\\').pop();
                        alert(name);

                        var parseFile = new Parse.File(file_name, file);

                        parseFile.save().then(function() {
                            // The file has been saved to Parse.
                            console.log("saved");
                            console.log(this);
                        }, function(error) {
                            // The file either could not be read, or could not be saved to Parse.
                            console.log(error);
                        });
                    }

                    brandObj.save(null,{
                        success: function(obj){
                            var modal=$("#myModal");
                            modal.click();
                            showSuccessToast(name+" Successfully Saved.",false);
                        },
                        error: function(err){
                            console.log(err);
                        }
                    });
                },
                error: function(object, error) {
                    // The object was not retrieved successfully.
                    // error is a Parse.Error with an error code and message.
                }
            });

        });
    </script>

    <body>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit <?php echo $class; ?></h4>
    </div>
    <div class="modal-body">
        <div class="panel-body">
            <div class="row">
                <div id="formNotification"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form action="" method="post" role="form" enctype="multipart/form-data" id="brand_form">
                        <div class="form-group">
                            <label>Brand Name</label>
                            <input class="form-control" name="brand_name"  id="brand_name" placeholder="Brand Name" value="<?=$object->get("name")?>">

                            <p class="help-block">Enter the Brand's Name.</p>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Multiplier</label>
                            <input type="number" class="form-control" name="brand_multiplier"  id="brand_multiplier" placeholder="Brand Multiplier" value="<?=$object->get("multiplier")?>">

                            <p class="help-block">Enter the Brand's Multiplier.</p>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Location</label>
                            <input class="form-control" name="brand_location" id="brand_location" placeholder="Location" value="<?=$object->get("location")?>">

                            <p class="help-block">Enter the Brand's location.</p>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="brand_description" id="brand_description" style="width:100%" rows="6"><?=$object->get("description")?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Brand Image</label>
                            <img src="<?=$object->get('brandImage')->getUrl()?>" width="80"/>
                            <input type="file" id="brand_image" name="brand_image">
                            <input type="hidden" id="brand_objectId" name="brand_objectId" value="<?=$object->getObjectId()?>">
                        </div>
                    </form>
                </div>
                <!-- /.col-lg-6 (nested) -->
            </div>
            <!-- /.row (nested) -->
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="save_changes" type="button" class="btn btn-primary">Save changes</button>
    </div>
    </body>

<?php
}
?>