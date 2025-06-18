@include('includes/header')

<style>
    #map {
        height: 300px;
        width: 100%;
    }

    .styled-image {
        height: 300px;
        width: 100%;
        margin: 10px 0;
        /* Adjust the margin as needed */
        border-radius: 15px;
        /* Adjust the radius as needed */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Adjust the shadow as needed */
    }
</style>

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
                                <li class="breadcrumb-item active">Reports</li>
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
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Ammonia Level</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Datetime</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($reports) && count($reports) > 0)
                                            @foreach ($reports as $index => $report)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    {{-- <td>
                                                    <img onclick="window.open(this.src)"
                                                        src="{{ asset('../storage/images/arts/' . $request['photo']) }}"
                                                        alt="Product {{ $index + 1 }}"
                                                        class="img-fluid img-size-64 mr-2">
                                                    {{ $request['name'] }}
                                                </td> --}}
                                                    <td>{{ $report['ammonia'] }}</td>
                                                    <td>{{ $report['description'] }}</td>
                                                    @if ($report['status'] == 0)
                                                        <td><span class="badge badge-success">Normal</span></td>
                                                    @elseif ($report['status'] == 1)
                                                        <td><span class="badge badge-primary">High</span></td>
                                                    @elseif ($report['status'] == 2)
                                                        <td><span class="badge badge-primary">Cleaned</span></td>
                                                    @endif
                                                    <td>{{ $report['datetime'] }}</td>

                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
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
