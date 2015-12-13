<?php include('../files/global.php'); ?>
<?php
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseFile;

$post_message = "";

if(isset($_POST['submit_brand'])) {

    $brand = new ParseObject("Brand");
    $brand->set("name", $_POST['brand_name']);
    $brand->set("location", $_POST['brand_location']);
    $brand->set("multiplier", (int)$_POST['brand_multiplier']);
    $brand->set("description", $_POST['brand_description']);

    $file = ParseFile::createFromData(file_get_contents($_FILES['brand_image']['tmp_name']), $_FILES['brand_image']['name']);
    $file->save();

    $brand->set("brandImage", $file);

    $brand->save();

    $post_message = "BRAND SAVED";
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

        <title>Add Brands - <?= $SITE_NAME ?> </title>

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
            <?php
            if($post_message!=""){
            ?>
            var form_noti = "<div class=\"alert alert-success\">BRAND SUCCESSFULLY SAVED</div>";
            $("#formNotification").html(form_noti);
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
                <h1 class="page-header">Add Brand</h1>
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
                        Adding a New Brand
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div id="formNotification"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="" method="post" role="form" enctype="multipart/form-data" id="brand_form">
                                    <div class="form-group">
                                        <label>Brand Name</label>
                                        <input class="form-control" name="brand_name" placeholder="Brand Name">
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
    