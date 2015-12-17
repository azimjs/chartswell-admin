<?php include('../files/global.php'); ?>
<?php
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseFile;

$post_message = "";

if(isset($_POST['submit_beacon'])) {

    $beacon = new ParseObject("Beacon");

    $brandQuery = new ParseQuery("Brand");
    $beacon_brand = $brandQuery->get($_POST['beacon_brand']);

//    print_r($beacon_brand);

    $relation = $beacon->getRelation("brand");
    $relation->add($beacon_brand);

    $regionQuery = new ParseQuery("Region");
    $beacon_region = $regionQuery->get($_POST['beacon_region']);

    $beacon->set("UUID", $_POST['beacon_uuid']);
    $beacon->set("major", intval($_POST['beacon_major']));
    $beacon->set("minor", intval($_POST['beacon_minor']));
    $beacon->set("name", $_POST['beacon_name']);
    $beacon->set("region", $beacon_region);
    $beacon->set("type", $_POST['beacon_type']);

//    print_r($beacon);
    try {
        $beacon->save();
//        echo 'New object created with objectId: ' . $beacon->getObjectId();
    } catch (ParseException $ex) {
        // Execute any logic that should take place if the save fails.
        // error is a ParseException object with an error code and message.
//        echo 'Failed to create new object, with error message: ' . $ex->getMessage();
    }


    $post_message = "BEACON SAVED";
//    exit;
}
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Add Beacon - <?= $SITE_NAME ?> </title>

        <?php
        $include_type = "header";
        include('../files/includes.php');
        ?>

    </head>

    <body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include('../files/left-navigation.php'); ?>

        <?php content(); ?>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php
    $include_type = "footer";
    include('../files/includes.php');
    ?>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true
            });
            <?php
            if($post_message!=""){
            ?>
            var form_noti = "<div class=\"alert alert-success\">BEACON SUCCESSFULLY SAVED</div>";
            $("#formNotification").html(form_noti);
            showSuccessToast(name+" Successfully Saved.",false);

            <?php
            }
            ?>

            $('#dataTables-example').DataTable({
                responsive: true
            });

            $("#brand_form").submit(function(){
                var error=false;
                var file=false;

                $("#brand_form :text").each(function(){
                    if($(this).val()=="") {
                        $(this).parent().addClass("has-error");
//                        error = true;
                        $(this).val("az");
                    }
                });
                /*
                 $("#brand_form textarea").each(function(){
                 if($(this).val()=="") {
                 $(this).parent().addClass("has-error");
                 error = true;
                 }
                 });
                 */
                if($("input:file").val().trim()=="") {
                    error = true;
                    file = true;
                }
                if(error){
                    console.log("error in form");
                    var form_error = "<div class=\"alert alert-danger\">Required Fields must not be left blank. </div>";
                    if(file)
                        form_error += "<div class=\"alert alert-danger\">Uploading Brand Image is Required. </div>";
                    $("#formNotification").html(form_error);
                    return false;
                }
            });
        });
    </script>

    </body>

    </html>

<?php
//---------------------------------------------
// THE MAIN CONTENT OF THE PAGE
//---------------------------------------------

function content()
{


    ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Add Beacons</h1>
                <h1>
                    <?php
                    echo isset($post_message)?$post_message:"";
                    ?>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Adding a New Beacon
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div id="formNotification"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="" method="post" role="form" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Beacon Name</label>
                                        <input class="form-control" name="beacon_name" placeholder="Name">
                                        <p class="help-block">Enter the Beacon's Name.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Type</label>
                                        <select class="form-control" name="beacon_type">
                                            <option value='Pass By'>Pass By</option>
                                            <option value='Cash Counter'>Cash Counter</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>UUID</label>
                                        <input class="form-control" name="beacon_uuid" placeholder="UUID">
                                        <p class="help-block">Enter the Beacon's UUID.</p>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Major</label>
                                        <input class="form-control" name="beacon_major" placeholder="Major">
                                        <p class="help-block">Enter the Beacon's Major.</p>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Minor</label>
                                        <input class="form-control" name="beacon_minor" placeholder="Minor">
                                        <p class="help-block">Enter the Beacon's Minor.</p>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Select Brand</label>
                                        <select class="form-control" name="beacon_brand">
                                            <?php
                                            $query = new ParseQuery("Brand");
                                            $pObj = $query->find();

                                            foreach($pObj as $brand){
                                                echo "<option value='".$brand->getObjectId()."'>".$brand->get("name")." -- ".$brand->get("location")."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Select Region</label>
                                        <select class="form-control" name="beacon_region">
                                            <?php
                                            $query = new ParseQuery("Region");
                                            $pObj = $query->find();

                                            foreach($pObj as $region){
                                                echo "<option value='".$region->getObjectId()."'>".$region->get("name")."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="submit" name="submit_beacon" class="btn btn-primary btn-lg btn-block">Submit</button>
                                    <button type="reset" class="btn btn-outline btn-primary btn-lg btn-block">Reset Button</button>
                                </form>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>

    <?php
}
    