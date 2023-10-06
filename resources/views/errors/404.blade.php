<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>404 Page Not Found</title>

    <style>
        #wrapper {
            display: flex;
            justify-content: center; /* Horizontally center the content */
            align-items: center; /* Vertically center the content */
            height: 100vh;
            background-color:#F8F9FC ;
        }

        #content-wrapper {
            text-align: center; /* Center the content horizontally */
        }
    </style>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/backend') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/backend') }}/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>

    <!-- Page Wrapper -->


    <div id="wrapper">
        <!-- Content Wrapper -->
        <div id="content-wrapper">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- 404 Error Text -->
                <div class="text-center">
                    <div class="error mx-auto" data-text="404">404</div>
                    <p class="lead text-gray-800 mb-5">Page Not Found</p>
                    <p class="text-gray-500 mb-0">The requested URL was not found on this server.</p>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
    </div>



    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/backend') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets/backend') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/backend') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/backend') }}/js/sb-admin-2.min.js"></script>

</body>

</html>
