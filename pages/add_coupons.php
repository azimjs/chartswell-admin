<?php include('../files/global.php'); ?>
<?php
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseFile;

$post_message = "";

if(isset($_POST['submit_coupon'])) {
    $brandQuery = new ParseQuery("Brand");
    $brand = $brandQuery->get($_POST['coupon_brand']);

    $coupon = new ParseObject("Coupon");
    $coupon->set("brand", $brand);
    $coupon->set("title", $_POST['coupon_title']);
    $coupon->set("type", $_POST['coupon_type']);
    $coupon->set("currentUsage", 0);
    $coupon->set("maxUsage", intval($_POST['coupon_max_usage']));

    $startDateTime = new DateTime($_POST['coupon_start_datetime']);
    $coupon->set("startDateTime", $startDateTime);

    $endDateTime = new DateTime($_POST['coupon_end_datetime']);
    $coupon->set("endDateTime", $endDateTime);

    $file = ParseFile::createFromData( file_get_contents( $_FILES['coupon_image']['tmp_name'] ), $_FILES['coupon_image']['name']  );
    $file->save();

    $coupon->set("file", $file);
    $coupon->set("visitThreshold", intval($_POST['coupon_visit_threshold']));

    $coupon->save();

    $post_message = "COUPON SAVED";
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

        <title>Add Coupons - <?= $SITE_NAME ?> </title>

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
                <h1 class="page-header">Add Coupons</h1>
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
                        Adding a New Coupon
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="" method="post" role="form" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Coupon Title</label>
                                        <input class="form-control" name="coupon_title" placeholder="Coupon Title">
                                        <p class="help-block">Enter the Coupon Title.</p>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Select Brand</label>
                                        <select class="form-control" name="coupon_brand">
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
                                        <label>Coupon Type</label>
                                        <select class="form-control" name="coupon_type">
                                            <option value='Public'>Public</option>;
                                            <option value='Pass By'>Pass By</option>;
                                            <option value='Sign Up'>Sign Up</option>;
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Max Usage</label>
                                        <input class="form-control" name="coupon_max_usage" placeholder="Max Usage">
                                        <p class="help-block">Enter the Max Usage of Coupon.</p>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Visit Threshold</label>
                                        <input class="form-control" name="coupon_visit_threshold" placeholder="Visit Threshold">
                                        <p class="help-block">Enter the Visit Threshold.</p>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>Start Date & Time</label>
                                        <input class="form-control" name="coupon_start_datetime" placeholder="YYYY-MM-DD HH:MM">
                                        <p class="help-block">Start Date & Time of Coupon.</p>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label>End Date & Time</label>
                                        <input class="form-control" name="coupon_end_datetime" placeholder="YYYY-MM-DD HH:MM">
                                        <p class="help-block">End Date & Time of Coupon.</p>
                                    </div>
                                    <div class="form-group">
                                        <label>Coupon Image</label>
                                        <input type="file" name="coupon_image">
                                    </div>

                                    <button type="submit" name="submit_coupon" class="btn btn-primary btn-lg btn-block">Submit</button>
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
    