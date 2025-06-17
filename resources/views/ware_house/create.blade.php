@extends('layout.master')
@push('css')
    <link
        href="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.6/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/date-1.5.3/fc-5.0.1/fh-4.0.1/r-3.0.3/rg-1.5.0/sc-2.4.3/sb-1.8.0/sl-2.0.5/datatables.min.css"
        rel="stylesheet">
    {{-- cái link nay dể đây vô file master datatable --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">

    {{-- <script src='https://api.mapbox.com/mapbox-gl-js/v3.7.0/mapbox-gl.js'></script> --}}
    <link href='https://api.mapbox.com/mapbox-gl-js/v3.7.0/mapbox-gl.css' rel='stylesheet' />
    <link href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css"
        rel="stylesheet" />
@endpush
@section('content')
    <div class="card">
        <div class="card-body ">
            <!-- Div chứa form sẽ được tải qua AJAX -->
            <div class="form-group" id="form-container" style="display: none;">
                <form action="{{ route('warehouses.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="name">Tên Kho Lúa:</label>
                    <input type="text" name="name" required><br>

                    <label for="address">ĐC Kho Lúa:</label>
                    <input type="text" name="address" required><br>

                    <label for="images">Hình Ảnh</label>
                    <input type="file" name="image" required><br>

                    <label for="longitude">Kinh Độ</label>
                    <input type="text" id="longitude" name="longitude" readonly><br>

                    <label for="latitude">Vĩ Độ:</label>
                    <input type="text" id="latitude" name="latitude" readonly><br>

                    <!-- Các trường khác của form -->
                    <button type="submit">Thêm</button>
                    <button type="button" id="close-form-btn" style="float:right; background-color: red">Đóng</button>
                </form>
            </div>

            <div id="search-container">
                <input type="text" id="search-bar" placeholder="Tìm kiếm kho lúa...">
                <button id="search-btn">Tìm kiếm</button>
            </div>
            <div id='map' style='width: 100%; height: 550px;'></div>
            <br>
            <table class="table table-striped table-centered mb-0" id="your-table-id">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Ten</th>
                        <th>Dia Chi</th>
                        <th>Hinh</th>
                        <th>Kinh do</th>
                        <th>Vi do</th>
                        <th>Xoa?Edit</th>
                    </tr>
                </thead>

            </table>



        </div>

    </div>
@endsection
@push('js')
    {{-- đẩy vào javascript     --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.6/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/date-1.5.3/fc-5.0.1/fh-4.0.1/r-3.0.3/rg-1.5.0/sc-2.4.3/sb-1.8.0/sl-2.0.5/datatables.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- link slect2 --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script src='https://api.mapbox.com/mapbox-gl-js/v3.7.0/mapbox-gl.js'></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoidnVraGExIiwiYSI6ImNtMXJob2g4eTA5eDcyc3MzMTFlMDdzcWIifQ.lF4KYoQPb0s_ry11QpSjNw';
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/vukha1/cm2q6yx1h008e01quhkotafxd', // style URL
            center: [105.1087191, 9.9717099], // starting position [lng, lat]
            zoom: 7, // starting zoom
            hash: true,
        });
    </script>
    <script>
        // URL API mới
        const apiUrl = 'warehouses/geojson';
        //let markers = []; // Mảng lưu trữ tất cả các marker và tên kho

        map.on('load', () => {
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    map.addSource('warehouse-src', {
                        type: 'geojson',
                        data: data
                    });
                    map.addLayer({
                        'id': 'name',
                        'type': 'symbol',
                        'source': 'warehouse-src',
                        'layout': {
                            'text-field': ['get', 'name'], // Hiển thị tên kho bên cạnh biểu tượng
                            'text-size': 12, // Kích thước của icon
                            'text-offset': [0, 1.5], // Khoảng cách giữa icon và text
                        },
                        'paint': {
                            'text-color': '#FFFF33'
                        }
                    });
                    // Duyệt qua từng feature trong GeoJSON
                    data.features.forEach((feature) => {
                        // console.log(feature);
                        // Lấy kinh độ và vĩ độ từ dữ liệu GeoJSON
                        const [longitude, latitude] = feature.geometry.coordinates;

                        // Tạo marker
                        const marker = new mapboxgl.Marker({
                                color: '#FF0000'
                            })
                            .setLngLat([longitude, latitude]) // Vị trí của marker từ GeoJSON
                            .addTo(map); // Thêm marker vào bản đồ

                        // Tạo popup và gắn vào marker
                        const popup = new mapboxgl.Popup({
                                offset: 15,
                                maxWidth: '300px'
                            }) // Tạo popup với khoảng cách từ marker
                            .setHTML(`
                                    <div class="custom-container">
                                    <form class="form-group" action="#" method="POST">
                                        @csrf
                                        <input type="text" name="id" hidden value="${feature.properties.id}"/>
                                        <img src="/storage/${feature.properties.image || 'default.jpg'}"
                                                alt="${feature.properties.name}"
                                                style="width: 100%; height: 100px; object-fit: cover; margin-top: 10px;">
                                        <h4>Tên: ${feature.properties.name || 'Chưa có tên'}</h4>
                                        <p>Địa chỉ: ${feature.properties.address || 'Chưa có địa chỉ'}</p>
                                        <p>Kinh độ: ${longitude}</p>
                                        <p>Vĩ độ: ${latitude}</p>
                                        <button class="btn-delete" data-id="${feature.properties.id}"> Xoá </button>
                                        </form>
                                    </div>
                            `);
                        // Gắn sự kiện click cho marker để hiện popup
                        marker.setPopup(popup);

                        // // Lưu thông tin marker và tên vào mảng
                        // markers.push({marker, name, coordinates: [longitude, latitude]});
                        // Khi click vào marker, hiển thị popup và ẩn form nếu nó đang mở
                        marker.getElement().addEventListener('click', (e) => {
                            e.stopPropagation(); // Ngăn sự kiện click lan ra ngoài
                            popup.addTo(map); // Hiển thị popup
                            document.getElementById('form-container').style.display =
                                'none'; // Ẩn form thêm
                        });
                    });
                });
            // Đóng form khi nhấn nút Đóng
            document.getElementById('close-form-btn').addEventListener('click', function() {
                var formContainer = document.getElementById('form-container');
                formContainer.style.display = 'none'; // Ẩn form khi nhấn Đóng
            });
            // Hiển thị form khi click vào bản đồ
            map.on('click', (e) => {
                // Lấy kinh độ và vĩ độ từ vị trí click
                const longitude = e.lngLat.lng;
                const latitude = e.lngLat.lat;

                // Hiển thị form thêm với kinh độ và vĩ độ từ vị trí click
                document.getElementById('form-container').style.display = 'block';
                document.getElementById('longitude').value = longitude;
                document.getElementById('latitude').value = latitude;
            });
        });

        $('#search-btn').on('click', function() {
            const searchValue = $('#search-bar').val();

            $.ajax({
                url: `{{ route('warehouses.geojson') }}`,
                type: 'GET',
                data: {
                    query: searchValue
                },
                success: function(data) {

                    // Kiểm tra nếu layer 'warehouse-name' đang tồn tại thì xóa nó trước
                    if (map.getLayer('warehouse-name')) {
                        map.removeLayer('warehouse-name');
                    }

                    // Kiểm tra nếu source 'warehouse-src' đang tồn tại thì xóa nó trước
                    if (map.getSource('warehouse-src')) {
                        map.removeSource('warehouse-src');
                    }

                    // Thêm nguồn GeoJSON với kết quả tìm kiếm
                    map.addSource('warehouse-src', {
                        type: 'geojson',
                        data: data
                    });

                    // Thêm layer hiển thị kho lúa
                    map.addLayer({
                        'id': 'warehouse-name',
                        'type': 'symbol',
                        'source': 'warehouse-src',
                        'layout': {
                            //   'icon-image': 'marker-15', // Sử dụng biểu tượng marker mặc định của Mapbox
                            'text-field': ['get', 'name'], // Hiển thị tên kho lúa
                            'text-offset': [0, 1.25],
                            'text-anchor': 'top'
                        }
                    });

                    // Zoom vào kết quả tìm kiếm đầu tiên (nếu có)
                    if (data.features.length > 0) {
                        const firstFeature = data.features[0];
                        map.flyTo({
                            center: firstFeature.geometry.coordinates,
                            zoom: 15
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Lỗi:', error);
                }
            });
        });
    </script>
@endpush
