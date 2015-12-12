<?php include('../files/global.php'); ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Beacons - <?= $SITE_NAME ?> </title>

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
                <h1 class="page-header">Beacons</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Beacon Details
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>ObjectId</th>
                                    <th>Type</th>
                                    <th>Beacon Details</th>
                                    <th>Brand</th>
                                    <th>Region Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $beacons = getBeacons();
//                                    print_r($brands[2]);
                                    //echo $brands[2]->brandImage->getUrl(); //getting image
                                    //exit;
                                
                                    foreach($beacons as $beacon){
                                        ?>
                                        <tr class="gradeA">
                                            <td><?=$beacon->objectId?></td>
                                            <td><?=$beacon->type?></td>
                                            <td>
                                                <b>Name:</b><?=$beacon->name?><br/>
                                                <b>UUID:</b><?=$beacon->uuid?><br/>
                                                <b>Major:</b><?=$beacon->major?>, <b>Minor:</b><?=$beacon->minor?><br/>
                                            </td>
                                            <?php
                                            if($beacon->brand!=null) {
                                                ?>
                                            <td><img src="<?= $beacon->brand->brandImage ?>"
                                                     alt="<?= $beacon->brand->name ?> Logo"
                                                     width="40"><?= $beacon->brand->name ?>
                                            </td>
                                            <?php
                                               }
                                            else {
                                                ?>
                                                <td>No Brand Attached</td>
                                            <?php
                                            }
                                            ?>
                                        <td><?=$beacon->region->name?></td>
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