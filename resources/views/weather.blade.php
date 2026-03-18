@extends('layout')

@section('content')

<div class="container-fluid vh-100 d-flex align-items-center justify-content-center weather_container">
    <div class="row w-100">
        <div class="col mb-2">
            <div class="geolocation">
                <h1 class="d-flex justify-conten-start align-items-center">
                    <i class="bi bi-geo-alt me-2"></i>
                    <span>
                        <span class="city"></span>
                        <span class="country"></span>
                        <span class="date"></span>
                    </span>
                </h1>

                <div class="box">
                    <div class="celcius_container d-inline-flex position-relative celcius"></div>
                    <div class="description_container"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">

            <div class="row">
                <!-- First Column -->
                <div class="col-md-6 mb-3">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div class="container-header d-flex justify-content-start align-items-center"><i
                                    class="bi bi-clock-history me-2"></i><span class="text-uppercase">time</span>
                            </div>
                            <div class="container-body time"></div>
                            <div class="container-footer">
                                <p>Current time display</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Second Column -->
                <div class="col-md-6 mb-3">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div class="container-header d-flex justify-content-start align-items-center"><i
                                    class="bi bi-stack me-2"></i><span class="text-uppercase">source</span></div>
                            <div class="container-body source"></div>
                            <div class="container-footer">
                                <p>Where the data fetch</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feels Like -->
                <div class="col-md-6 mb-3">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div class="container-header d-flex justify-content-start align-items-center"><i
                                    class="bi bi-thermometer-sun me-2"></i><span class="text-uppercase">feels
                                    like</span></div>
                            <div class="container-body d-inline-flex position-relative feels_like"></div>
                            <div class="container-footer">
                                <p>Humidity is making it feel warmer</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Humidity -->
                <div class="col-md-6 mb-3">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div class="container-header d-flex justify-content-start align-items-center"><i
                                    class="bi bi-wind me-2"></i><span class="text-uppercase">humidity</span></div>
                            <div class="container-body humidity"></div>
                            <div class="container-footer">
                                <p>The dew point is currently <span class="humidity_desc"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script type="module">
weather.onLoadPage()
</script>
@endpush