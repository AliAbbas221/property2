@extends('layouts.admin.main')


@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    {{-- <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Announcements:</h5>
                        NEW label is for announcements published within last 24 hr.
                    </div> --}}


                    <!-- Main content -->
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="row">
                                <div class="col-12">

                                    <div class="form-group">
                                        <label>نوع المنشور :</label>
                                        <select class="form-control" style="width: 100%;"
                                            onchange="showPostForm(this.value,{{ $id }})">
                                            <option selected value="0" hidden></option>
                                            <option value="1">عقارات</option>
                                            <option value="2">سيارات</option>
                                            <option value="3">أغراض مستعملة</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12" id="post-form"></div>

                            </div>

                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection


<!-- gmap api -->
<script>
    (g => {
        var h, a, k, p = "The Google Maps JavaScript API",
            c = "google",
            l = "importLibrary",
            q = "__ib__",
            m = document,
            b = window;
        b = b[c] || (b[c] = {});
        var d = b.maps || (b.maps = {}),
            r = new Set,
            e = new URLSearchParams,
            u = () => h || (h = new Promise(async (f, n) => {
                await (a = m.createElement("script"));
                e.set("libraries", [...r] + "");
                for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                e.set("callback", c + ".maps." + q);
                a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                d[q] = f;
                a.onerror = () => h = n(Error(p + " could not load."));
                a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                m.head.append(a)
            }));
        d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() =>
            d[l](f, ...n))
    })
    ({
        key: "AIzaSyDCSt4ABayMg8O3n9Hvxb_vrs_1oUfWXuA",
        v: "weekly"
    });
</script>

@push('scripts')
    <script>
        //get doctor clinic coord
        let clinic_pos, marker;
        let map;
        const pos = {
            lat: 34.7324,
            lng: 36.7137
        };

        async function initMap() {

            // Request needed libraries.
            //@ts-ignore
            const {
                Map
            } = await google.maps.importLibrary("maps");


            // The map, centered at the clinic
            map = new Map(document.getElementById("map"), {
                zoom: 15,
                center: pos,
                mapId: "map",
                scrollwheel: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: true,
                zoomControl: true,
                fullscreenControl: true,
            });

            // The marker, positioned at the clinic
            marker = new google.maps.Marker({
                map: map,
                position: pos,
                title: "clinic",
                draggable: true,

            });
            google.maps.event.addListener(marker, 'dragend', function(marker) {
                clinic_pos = marker.latLng;

                $('#lat_add').val(clinic_pos.lat());
                $('#long_add').val(clinic_pos.lng());

                // alert($('#lat_add').val());
                // alert($('#long_add').val());
            });
        }



      
    </script>
    <script>
        var f_count

        function showPostForm(type, id) {
            if (type != "0") {
                $.ajax({
                    url: "{{ route('admin.post.form') }}",
                    data: {
                        type: type,
                        id: id
                    },
                    success: function(data) {
                        f_count = 0;
                        $('#post-form').html(data);
                        if(type==1){
                            initMap();
                        }
                        //$('#report-result').html('');
                    }
                });

            }
        }


        function show_models(e) {
            id = $(e).val();
            //alert(id);
          //  console.log(id);
            get_url = "{{ route('admin.cars.modelByManufacture', ['id' => 'sid']) }}";
            get_url = get_url.replace("sid", id);
            $.ajax({
                type: 'GET',
                url: get_url,
                data: {
                    id: id
                },
                success: function(data) {
                    //console.log(data);
                    if (data == '') {
                        var st = '<option  hidden >لا يوجد إصدارات مضافة لهذا المُصنع</option>';
                        //  $("program_id option:selected").prop("selected", false)
                        $('#submit').prop('disabled', true);
                        //$('#model').prop('multiple', false);
                        $('#model').prop('disabled', true);
                    } else {
                        $('#submit').prop('disabled', false);
                        $('#model').prop('disabled', false);
                        //  $('#model').prop('multiple', true);
                        var st = '<option value="" hidden></option>';
                        //   st += '<option value="">hiiiiiiii</option>';
                        $.each(data, function(index) {
                            st += '<option value="' + data[index].carmodelid + '">' + data[index]
                                .modelname +
                                '</option>';
                        })
                    }
                    $('#model').html(st)

                },
                error: function(rejest) {}

            });

        }

        function show_citys(e) {
            id = $(e).val();
            //alert(id);
           // console.log(id);
            get_url = "{{ route('admin.cars.cityByCountry', ['id' => 'sid']) }}";
            get_url = get_url.replace("sid", id);
            $.ajax({
                type: 'GET',
                url: get_url,
                data: {
                    id: id
                },
                success: function(data) {
                   // console.log(data);
                    if (data == '') {
                        var st = '<option  hidden >لا يوجد مدن مضافة لهذا البلد</option>';
                        //  $("program_id option:selected").prop("selected", false)
                        $('#submit').prop('disabled', true);
                        //$('#model').prop('multiple', false);
                        $('#city').prop('disabled', true);
                    } else {
                        $('#submit').prop('disabled', false);
                        $('#city').prop('disabled', false);
                        //  $('#city').prop('multiple', true);
                        var st = '<option value="" hidden></option>';
                        //   st += '<option value="">hiiiiiiii</option>';
                        $.each(data, function(index) {
                            st += '<option value="' + data[index].cityId + '">' + data[index]
                                .name +
                                '</option>';
                        })
                    }
                    $('#city').html(st)

                },
                error: function(rejest) {}

            });

        }



        var html = ` <div>
    <div class="form-group" >
        <span class="close mx-2"
            onclick="remove_field(this)">&times;</span>
        <label for="city">اسم الحقل</label>
        <input type="text"
            class="form-control  @error('labels[]') is-invalid @enderror"
            name="labels[]" id="labels[]"
            value="" required>
        <label for="city">قيمة الحقل</label>
        <input type="text"
            class="form-control  @error('values[]') is-invalid @enderror"
            name="values[]" id="values[]"
            value="" required>
    </div>
    
</div>`;

        function add_extra() {

            values = ($("input[name='values[]']")
                .map(function() {
                    return $(this).val();
                }).get());
            labels = ($("input[name='values[]']")
                .map(function() {
                    return $(this).val();
                }).get());
            if (values[f_count - 1] == '' || labels[f_count - 1] == '') {
                // console.log('empty');
                alert('الرجاء إدخال اسم وقيمة الحقل قبل إضافة حقل جديد !');
            }
            if (values[f_count - 1] != '' && labels[f_count - 1] != '') {
                //   console.log(values[f_count - 1]);

                $('#extra').append(html);
                f_count++;
               // alert(f_count);
            }
        }

        function remove_field(field_el) {
          //  console.log(field_el.parentNode.parentNode);
            $(field_el.parentNode.parentNode).remove();
        }
    </script>
@endpush
