@include('includes/header')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ url('storage/images/applogo.png') }}" alt="AAC" height="180"
                width="180">
            <h1>Ammonia AutoControl</h1>
        </div>
        @include('includes/navbar')
        @include('includes/menubar')
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Reviews</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Help</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                @if ($errors->any())
                    <div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-warning'></i> Error!</h4>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session()->has('success'))
                    <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check'></i> Success!</h4>
                        <ul>
                            {{ session()->get('success') }}
                        </ul>
                    </div>
                @endif
                <div class="container-fluid">
                    <div class="row">
                        <div class="card" style="width:100%;">
                            <div class="card-header">
                                {{-- <a href="#add" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i
                                        class="fas fa-plus"></i> New</a> --}}
                            </div>
                            <div class="card-body">
                                <h1>How to Use the Website</h1>
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h2>Login</h2>
                                    </div>
                                    <div class="card-body">
                                        <p>To access the website, go to the login page and enter your credentials.</p>
                                        <ul>
                                            <li>Enter your email and password.</li>
                                            <li>Click the "Login" button.</li>
                                            <li>If the credentials are correct, you will be redirected to the dashboard.
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h2>Dashboard</h2>
                                    </div>
                                    <div class="card-body">
                                        <p>The dashboard provides an overview of ammonia levels and settings.</p>
                                        <ul>
                                            <li>View the current ammonia level.</li>
                                            <li>Set the highest ammonia limit.</li>
                                            <li>Switch between manual and automatic mode.</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h2>Reports</h2>
                                    </div>
                                    <div class="card-body">
                                        <p>The reports page allows you to review historical ammonia level data.</p>
                                        <ul>
                                            <li>Filter reports by date range.</li>
                                            <li>Export data as CSV or PDF.</li>
                                            <li>View trends and analytics.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
            </section>
        </div>
    </div>
    </section>
    </div>
    @include('includes/footer')
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
    </div>
    @include('includes/scripts')

    <script>
        $(function() {

            $('#example1 tbody').on("click", ".approve", function() {
                $('#approve').modal('show');

                var id = $(this).data('id');
                // var business_permit = $(this).data('business_permit');
                // var fire_safety_permit = $(this).data('fire_safety_permit');

                var formAction = '/admin/store/product/approve/' + id;

                $('#formApprove').attr('action', formAction);
                // $('#business_permit').attr('src', 'data:image/png;base64,' + business_permit);
                // $('#fire_safety_permit').attr('src', 'data:image/png;base64,' + fire_safety_permit);

                $('#formApprove').attr('action', formAction);
            });
            $('#example1 tbody').on("click", ".reject", function() {
                $('#reject').modal('show');
                var id = $(this).data('id');
                var formAction = '/admin/store/product/reject/' + id;
                $('#formReject').attr('action', formAction);
            });
        });
    </script>

</body>

</html>
