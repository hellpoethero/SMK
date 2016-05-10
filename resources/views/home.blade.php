@extends('layouts.app')
@section('page')
<h2>Trang chủ</h2>
@endsection
@section('content')
    <link href="{{asset('css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">
    <script src="{{asset('js/plugins/toastr/toastr.min.js')}}"></script>

    <div class="row">
        <div class="col-lg-7">
            <div class="ibox float-e-margins shadow" id="map" style="height: 384px;">
            </div>
        </div>
        <div class="col-lg-5">
            <div class="ibox float-e-margins shadow">
                <div class="ibox-title">
                    <h5>Các cửa hàng trong bán kính 1km</h5>
                    <div class="ibox-tools">
                        <span class="label label-warning-light"> ... kết quả</span>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="feed-activity-list" id="near_location">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Hệ thống phân tích Facebook', 'Chào mừng đến với SMK');
            }, 1300);
        });
    </script>
    <script>
        var map;
        var marker;
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 16.010922, lng: 107.7869543},
                zoom: 4
            });
            var infoWindow = new google.maps.InfoWindow({map: map});
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    infoWindow.setPosition(pos);
                    infoWindow.setContent('Vị trí của bạn');
                    map.setCenter(pos);
                    map.setZoom(17);

                    searchNearLocation(pos, map);

                    var icon = {
                        url: '{{asset('icon/location.png')}}',
                        scaledSize: new google.maps.Size(24, 24),
                        anchor: new google.maps.Point(13,13)
                    }
                    myLocation = new google.maps.Marker({
                        position: pos,
                        map: map,
                        icon: {
                            url: '{{asset('icon/location.png')}}',
                            scaledSize: new google.maps.Size(24, 24),
                            anchor: new google.maps.Point(13,13)
                        },
                    });

                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                    'Error: The Geolocation service failed.' :
                    'Error: Your browser doesn\'t support geolocation.');
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0wQmS_WbJifsGQZPIGttOHBYdqvKrwbw&callback=initMap"
            async defer>
    </script>
    <script>
        function searchNearLocation(pos, map) {
            var url = 'http://localhost:8000/api?type=source&location='+pos['lat']+','+pos['lng'];
            $.getJSON(url, function(data) {
                var near_location = document.getElementById("near_location");
                near_location.innerHTML = "";
                $.each(data, function(index, value) {
                    createNodeList(value, near_location);
                    createNodeMap(value, map);
                });
            });
        }

        function createNodeMap(value, map) {
            var lat = value['_source']['location'].substr(0, value['_source']['location'].indexOf(','));
            var lon = value['_source']['location'].substr(value['_source']['location'].indexOf(',')+1, value['_source']['location'].length);
            var location = new google.maps.LatLng(lat, lon);

            var icon = {
                url: value['_source']['picture'],
                scaledSize: new google.maps.Size(20, 20)
            };
            var marker = new google.maps.Marker({
                position: location,
                map: map,
                title: value['_source']['name'],
                icon: icon,
            });

            var infowindow = new google.maps.InfoWindow({
                content: "<h3><strong>"+value['_source']['name']+"</strong></h3>"
                +value['_source']['category']+" - "+ "<strong>"+value['_source']['likes']+"</strong> lượt thích<br>"
                +"Địa chỉ: "+"<strong>"+value['_source']['address']+"</strong>"
            });

            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });
        }

        function createNodeList(value, near_location) {
            var feed = document.createElement('div');
            feed.className = "feed-element";

            var left = document.createElement('span');
            left.className = "col-md-2";
            left.style.textAlign = "center";
            left.innerHTML = '<img alt="image" class="img-circle" src="'+value['_source']['picture']+'">';

            var center = document.createElement('span');
            center.className = "col-md-8"
            var a = document.createElement('a');
            a.href = "#";
            a.innerHTML = "<strong>"+value['_source']['name']+"</strong><br>";
            var small = document.createElement('small');
            small.className = "text-muted";
            var div_small = document.createElement('div');
            div_small.innerHTML = value['_source']['category']+" - "+ "<strong>"+value['_source']['likes']+"</strong> lượt thích";
            small.appendChild(div_small);
            var address = document.createElement('div');
            address.innerHTML = "Địa chỉ: "+"<strong>"+value['_source']['address']+"</strong>";
            center.appendChild(a);
            center.appendChild(small);
            if (value['_source']['address']!=null) {
                center.appendChild(address);
            }

            var right = document.createElement('span');
            right.className = "col-md-2";
            right.innerHTML = value['sort'][0].toFixed(2) + " met";

            feed.appendChild(left);
            feed.appendChild(center);
            feed.appendChild(right);

            near_location.appendChild(feed);
        }
    </script>
@endsection