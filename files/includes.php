<?php
/**
 * Created by PhpStorm.
 * User: Azim
 * Date: 10/22/2015
 * Time: 11:46 AM
 */
?>
<?php if ($include_type == "header") {
    ?>
<!--    <script src="//www.parsecdn.com/js/parse-1.6.7.min.js"></script>
    <script type="text/javascript">
        Parse.initialize("qQbKbAOfCCv21GorToroCgmZSFRUzNfjKphATSgR", "qA320hR1s86oFIdMOfkeQ0bQgxGPrefielB0qFHF");
/*
        var TestObject = Parse.Object.extend("TestObject");
        var testObject = new TestObject();
        testObject.save({foo: "bar"}).then(function(object) {
            alert("yay! it worked");
        });
*/
    </script>-->
    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css"
          rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link type="text/css" href="../dist/jquery-toastmessage-plugin/src/main/resources/css/jquery.toastmessage.css" rel="stylesheet"/>
    <?php
}
if ($include_type == "footer") {
    ?>
    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../dist/jquery-toastmessage-plugin/src/main/javascript/jquery.toastmessage.js"></script>

    <script type="text/javascript">

        function showSuccessToast(message,sticky) {
            $().toastmessage('showToast', {
                text     : message,
                sticky   : sticky,
                position : 'middle-center',
                type     : 'success',
                closeText: '',
                close    : function () {
                    console.log("toast is closed ...");
                }
            });
        }

        function showNoticeToast(message,sticky) {
            $().toastmessage('showToast', {
                text     : message,
                sticky   : sticky,
                position : 'middle-center',
                type     : 'notice',
                closeText: '',
                close    : function () {console.log("toast is closed ...");}
            });
        }

        function showWarningToast(message,sticky) {
            $().toastmessage('showToast', {
                text     : message,
                sticky   : sticky,
                position : 'middle-center',
                type     : 'warning',
                closeText: '',
                close    : function () {
                    console.log("toast is closed ...");
                }
            });
        }

        function showErrorToast(message,sticky) {
            $().toastmessage('showToast', {
                text     : message,
                sticky   : sticky,
                position : 'middle-center',
                type     : 'error',
                closeText: '',
                close    : function () {
                    console.log("toast is closed ...");
                }
            });
        }

    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>


    <?php
}
?>