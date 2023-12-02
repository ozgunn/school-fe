<?php
// Panel Theme: https://startbootstrap.com/previews/sb-admin-2
?>
    <!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{ asset('css/main.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/jquery.toast.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">


    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    @include('layouts.sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('layouts.topnav')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; 2023</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Page level custom scripts -->
{{--<script src="js/demo/chart-area-demo.js"></script>--}}
{{--<script src="js/demo/chart-pie-demo.js"></script>--}}
{{--<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>--}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
{{--<script src="{{ asset('js/jquery.toast.min.js') }}"></script>--}}
<script src="{{ asset('js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {

        @if(session('success'))
            Toast("success", "{{ session('success') }}", "");
            @php
                session()->forget('success');
            @endphp
        @endif

        @if(session('error'))
            Toast("error", "{{ trans('An error occurred') }}", '', '{{ json_encode(session('error')) }}');
            @php
                session()->forget('error');
            @endphp
        @endif

        $('[data-toggle="tooltip"]').tooltip();

        $(".delete").on("click", function (e) {
            e.preventDefault();
            var href = $(this).attr("href");
            var deleteLink = $(this);
            $.confirm({
                backgroundDismiss: true,
                theme: 'modern',
                title: '{{trans('Delete Confirmation')}}',
                content: '{{trans('Are you sure you want to delete this item?')}}',
                buttons: {
                    confirm: {
                        text: '{{trans('Confirm')}}',
                        btnClass: 'btn-danger',
                        action: function () {
                            $.ajax({
                                type: "DELETE",
                                url: href,
                                data: {
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function (response) {
                                    var trElement = deleteLink.closest("tr");

                                    trElement.fadeOut(500, function () {
                                        deleteLink.tooltip('hide');
                                        $(this).remove();
                                    });

                                    Toast("success", "{{ trans('Delete successfully') }}", "");

                                },
                                error: function (error) {
                                    console.error("Error during deletion:", error);
                                    Toast("error", "{{ trans('Delete failed') }}", error.responseJSON?.errorMsg ?? "{{ trans('Delete failed') }}");
                                }
                            });
                        }
                    },
                    cancel: {
                        text: '{{trans('Cancel')}}'
                    }
                }
            });

        });
    });

</script>
</body>

</html>
