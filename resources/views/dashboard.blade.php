@include('includes/header')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
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
                            <h1>Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Ammonia Level (ppm)</h3>
                                </div>
                                <div class="card-body text-center">
                                    <input type="text" class="knob" value="0" data-width="120"
                                        data-height="120" data-fgColor="#3c8dbc">
                                    <p class="mt-3">Current Ammonia Level</p>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Ammonia Limit</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('save.ammonia.limit') }}" method="POST">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" name="ammonia_limit"
                                                placeholder="Enter highest limit"
                                                value="{{ $settings['ammonia_limit'] }}"required>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Mode Selection</h3>
                                </div>
                                <div class="card-body text-center">
                                    <label class="switch">
                                        <input type="checkbox" id="modeToggle"
                                            {{ isset($settings['automatic']) && $settings['automatic'] == 1 ? 'checked' : '' }}
                                            onchange="updateMode(this.checked)">
                                        <span class="slider round"></span>
                                    </label>
                                    <p id="modeText" class="mt-2">
                                        {{ isset($settings['automatic']) && $settings['automatic'] == 1 ? 'Automatic Mode' : 'Manual Mode' }}
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success mt-2">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </section>
        </div>

        @include('includes/footer')
        @include('includes/scripts')
    </div>



    <!-- jQuery -->
    @include('includes/scripts')

    <script>
        $(function() {
            /* jQueryKnob */


            $('.knob').knob({
                /*change : function (value) {
                 //console.log("change : " + value);
                 },
                 release : function (value) {
                 console.log("release : " + value);
                 },
                 cancel : function () {
                 console.log("cancel : " + this.value);
                 },*/
                min: 0,
                max: 100,
                step: 0.1, // Allow decimal increments
                decimals: 2, // Ensure two decimal places
                draw: function() {

                    // "tron" case
                    if (this.$.data('skin') == 'tron') {

                        var a = this.angle(this.cv) // Angle
                            ,
                            sa = this.startAngle // Previous start angle
                            ,
                            sat = this.startAngle // Start angle
                            ,
                            ea // Previous end angle
                            ,
                            eat = sat + a // End angle
                            ,
                            r = true

                        this.g.lineWidth = this.lineWidth

                        this.o.cursor &&
                            (sat = eat - 0.3) &&
                            (eat = eat + 0.3)

                        if (this.o.displayPrevious) {
                            ea = this.startAngle + this.angle(this.value)
                            this.o.cursor &&
                                (sa = ea - 0.3) &&
                                (ea = ea + 0.3)
                            this.g.beginPath()
                            this.g.strokeStyle = this.previousColor
                            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
                            this.g.stroke()
                        }

                        this.g.beginPath()
                        this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
                        this.g.stroke()

                        this.g.lineWidth = 2
                        this.g.beginPath()
                        this.g.strokeStyle = this.o.fgColor
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth *
                            2 / 3, 0, 2 * Math.PI, false)
                        this.g.stroke()

                        return false
                    }
                }
            })
            /* END JQUERY KNOB */

        })
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            function fetchData() {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var data = JSON.parse(this.responseText);
                        getData(data);
                    }
                };
                xhr.open("GET", "/dashboard/fetch", true);
                xhr.send();
            }

            function getData(datas) {
                //console.log(datas);
                $('.knob').val(datas.ammonia1).trigger('change'); // Update the knob value
            }

            // Function to show ammonia alert
            function showAmmoniaAlert(title, message) {
                var alertHtml = `<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="dismissAlert()">&times;</button>
                        <h5><i class="icon fas fa-fire"></i>${title}</h5>
                        ${message}
                    </div>`;
                // Append the alert to the card body
                document.querySelector('.card-body').insertAdjacentHTML('beforeend', alertHtml);

            }


            // Call fetchData() immediately
            fetchData();
            // Call fetchData() every 5 seconds
            setInterval(fetchData, 5000);
        });
    </script>
    <script>
        function updateMode(isChecked) {
            var mode = isChecked ? 1 : 0; // Convert checkbox state to 1 or 0

            fetch("{{ url('dashboard/update-mode') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        automatic: mode
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modeText').innerText = isChecked ? "Automatic Mode" : "Manual Mode";
                    console.log("Mode updated:", data);
                })
                .catch(error => console.error("Error updating mode:", error));
        }
    </script>


</body>

</html>
