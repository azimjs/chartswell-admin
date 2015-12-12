<?php include('../files/global.php'); ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Coupons - <?= $SITE_NAME ?> </title>

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
                <h1 class="page-header">Coupons</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Coupon Details
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>ObjectId</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Coupon Image</th>
                                    <th>Brand</th>
                                    <th>Visit Threshold</th>
                                    <th>Current Usage</th>
                                    <th>Max Usage</th>
                                    <th>Start Date Time</th>
                                    <th>End Date Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $coupons = getCoupons();
//                                    print_r($brands[2]);
                                    //echo $brands[2]->brandImage->getUrl(); //getting image
                                    //exit;
                                
                                    foreach($coupons as $coupon){
                                        ?>
                                        <tr class="gradeA">
                                            <td><?=$coupon->objectId?></td>
                                            <td><?=$coupon->title?></td>
                                            <td><?=$coupon->type?></td>
                                            <td><a href="<?=$coupon->file?>"><img src="<?=$coupon->file?>" alt="<?=$coupon->file?> Logo" width="40"></a> </td>
                                            <td><a href="<?=$coupon->brand->brandImage?>"><img src="<?=$coupon->brand->brandImage?>" alt="<?=$coupon->brand->name?> Logo" width="40"> <?=$coupon->brand->name?></a></td>
                                            <td><?=$coupon->visitThreshold?></td>
                                            <td><?=$coupon->currentUsage?></td>
                                            <td><?=$coupon->maxUsage?></td>
                                            <td><?=$coupon->startDateTime->format('Y-m-d H:i:s')?></td>
                                            <td><?=$coupon->endDateTime->format('Y-m-d H:i:s')?></td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->

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