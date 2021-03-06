<?php include('../files/global.php'); ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Brands - <?= $SITE_NAME ?> </title>

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
                <h1 class="page-header">Brands</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Brand Details
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th width="40">Edit</th>
                                    <th>ObjectId</th>
                                    <th>Brand Name</th>
                                    <th>Logo</th>
                                    <th>Location</th>
                                    <th>Multiplier</th>
                                    <th>Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $brands = getBrands();
                                    foreach($brands as $brand){
                                        echo "
                                        <tr>
                                            <td align='center'>
                                                <a class='open-modal' data-toggle='modal' href='../files/ajax.php?class=Brand&objectId=$brand->objectId&name=$brand->name&type=edit' data-target='#myModal'>
                                                <i class='fa fa-pencil-square' style='font-size: 20px;transition: color 1s;'></i>
                                                </a>
                                            </td>
                                            <td onclick=\"showSuccessToast('az',false)\">$brand->objectId</td>
                                            <td>$brand->name</td>
                                            <td><img src='$brand->brandImage' width='30' /></td>
                                            <td>$brand->location</td>
                                            <td>$brand->multiplier</td>
                                            <td>$brand->description</td>
                                        </tr>

                                    ";
                                    //echo $brands[2]->brandImage->getUrl(); //getting image
                                    //exit;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                        <!-- Modal -->
                        <span id="onLoad" style="position:absolute;left:100px;top:100px;z-index:1000000;" hidden>Loading...</span>
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
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