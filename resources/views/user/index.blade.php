@extends('layout.master')
@push('css')
    <link
        href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.6/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/date-1.5.3/fc-5.0.1/fh-4.0.1/r-3.0.3/rg-1.5.0/sc-2.4.3/sb-1.8.0/sl-2.0.5/datatables.min.css"
        rel="stylesheet">
    {{-- cái link nay dể đây vô file master datatable --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- <script src='https://api.mapbox.com/mapbox-gl-js/v3.7.0/mapbox-gl.js'></script> --}}
    <link href='https://api.mapbox.com/mapbox-gl-js/v3.7.0/mapbox-gl.css' rel='stylesheet' />
@endpush
@section('content')
    <div class="card">
        <div class="card-body ">
            <div id='map' style='width: 100%; height: 550px;'>
            </div>

        </div>
    </div>
@endsection
@push('js')
    {{-- đẩy vào javascript     --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    {{-- <script 
    src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.6/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/date-1.5.3/fc-5.0.1/fh-4.0.1/r-3.0.3/rg-1.5.0/sc-2.4.3/sb-1.8.0/sl-2.0.5/datatables.min.js"></script>   
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>  --}}
    {{-- link slect2 --}}
    <script src='https://api.mapbox.com/mapbox-gl-js/v3.7.0/mapbox-gl.js'></script>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoidnVraGExIiwiYSI6ImNtMXJob2g4eTA5eDcyc3MzMTFlMDdzcWIifQ.lF4KYoQPb0s_ry11QpSjNw';
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v12', // style URL
            center: [105.1087191, 9.9717099], // starting position [lng, lat]
            zoom: 5, // starting zoom
            hash: true
        });
    </script>
    <script>
        // URL API mới
        const apiUrl = 'warehouses/geojson';
        map.on('load', () => {
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    map.addSource('warehouse-src', {
                        type: 'geojson',
                        data: data
                    });
                    map.addLayer({
                        'id': 'warehouse-name',
                        'type': 'symbol',
                        'source': 'warehouse-src',
                        'layout': {
                            'text-field': ['get', 'name'], // Hiển thị tên kho bên cạnh biểu tượng
                            'text-size': 12, // Kích thước của icon
                            'text-offset': [0,
                            1.5], // Khoảng cách giữa icon và text                    
                        },
                        'paint': {
                            'text-color': '#333300'
                        }
                    });
                    // Duyệt qua từng feature trong GeoJSON
                    data.features.forEach((feature) => {
                        // Lấy kinh độ và vĩ độ từ dữ liệu GeoJSON
                        const [longitude, latitude] = feature.geometry.coordinates;

                        // Tạo marker
                        const marker = new mapboxgl.Marker({
                                color: '#FF0000'
                            })
                            .setLngLat([longitude, latitude]) // Vị trí của marker từ GeoJSON
                            .addTo(map); // Thêm marker vào bản đồ  
                    });
                })
                .catch(error => {
                    console.error('Error loading data:', error);
                });
        });
    </script>
@endpush
