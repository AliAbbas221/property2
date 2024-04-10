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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title"></h3>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form action="{{ route('admin.property.create') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="title">عنوان المنشور</label>
                                            <input type="text" class="form-control  @error('title') is-invalid @enderror"
                                                name="title" id="title" value="{{ old('title') }}" pattern=".{4,}">
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="typeid">نوع العقار</label>
                                            <select class="form-control @error('typeid') is-invalid @enderror"
                                                name="typeid" id="typeid" required>

                                                <option value="" hidden></option>
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->property_type_id }}">{{ $type->typename }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('typeid')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="registration">نوع التسجيل</label>
                                            <select class="form-control @error('registration') is-invalid @enderror"
                                                name="registration" id="registration" required>

                                                <option value="" hidden></option>
                                                @foreach ($registrations as $registration)
                                                    <option value="{{ $registration->property_regestration_type_id }}">
                                                        {{ $registration->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('registration')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="operationtypeid">نوع العملية</label>
                                            <select class="form-control @error('operationtypeid') is-invalid @enderror"
                                                name="operationtypeid" id="operationtypeid">

                                                <option value="" hidden></option>
                                                @foreach ($operations as $operation)
                                                    <option value="{{ $operation->propertyoperationtypeid }}">
                                                        {{ $operation->operationtypename }}</option>
                                                @endforeach
                                            </select>
                                            @error('operationtypeid')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-10"> <label for="price">السعر</label>
                                                <input type="number" id="price" name="price" min="0"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    value="{{ old('price') }}" autocomplete="price" required>

                                                @error('price')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="">
                                                <label for="currency">العملة</label>
                                                <select class="form-control @error('currency') is-invalid @enderror"
                                                    name="currency" id="currency" required>

                                                    <option value="" hidden></option>
                                                    @foreach ($currencys as $currency)
                                                        <option value="{{ $currency->currency_name }}">
                                                            {{ $currency->currency_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('currency')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="location">الموقع</label>
                                            <input type="text"
                                                class="form-control  @error('location') is-invalid @enderror"
                                                name="location" id="location" value="{{ old('location') }}"
                                                pattern=".{4,}">

                                            @error('location')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="coordinates">الإحداثيات</label>

                                            <div id='map' class='form-control img-fluid'
                                                style='height:300px; width:100%;'></div>
                                            <input id="lat_add" type="text" name="coordinates[]" value=""
                                                style="  opacity: 0; width: 0;"
                                                oninvalid="this.setCustomValidity('ادخل موقع العقار')">
                                            <input id="long_add" type="text" name="coordinates[]" value=""
                                                style="  opacity: 0; width: 0;"
                                                oninvalid="this.setCustomValidity('ادخل موقع العقار')">
                                            @error('coordinates')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="areasize">المساحة</label>
                                            <input type="number"
                                                class="form-control  @error('areasize') is-invalid @enderror"
                                                name="areasize" id="areasize" value="{{ old('areasize') }}">

                                            <div id="map"></div>
                                            @error('areasize')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="status">الحالة</label>
                                            <input type="text"
                                                class="form-control  @error('status') is-invalid @enderror" name="status"
                                                id="status" value="{{ old('status') }}" pattern=".{4,}">

                                            <div id="map"></div>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="mainphoto">الصورة الرئيسية</label>
                                            <input type="file"
                                                class="form-control-file @error('mainphoto') is-invalid @enderror"
                                                name="mainphoto" id="mainphoto" accept="image/*">

                                            @error('mainphoto')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="mainphoto">صور إضافية</label>
                                            <input type="file"
                                                class="form-control-file @error('attachment') is-invalid @enderror"
                                                name="attachment[]" id="attachment" accept="image/*" multiple>

                                            @error('attachment')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="notes">ملاحظات</label>
                                            <textarea class="form-control  @error('notes') is-invalid @enderror" name="notes" id="notes">{{ old('notes') }}</textarea>


                                            @error('notes')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>



                                        <div class="form-group">
                                            <label for="country">البلد</label>
                                            <select class="form-control @error('country') is-invalid @enderror"
                                                name="country" id="country" onchange="show_citys(this)" required>

                                                <option value="" hidden></option>
                                                @foreach ($countrys as $country)
                                                    <option value="{{ $country->id }}">
                                                        {{ $country->country_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="city">المدينة</label>
                                            <select class="form-control @error('city') is-invalid @enderror"
                                                name="city" id="city" disabled required>


                                            </select>
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>


                                        <hr>

                                        <h3>تفاصيل العقار</h3>

                                        @foreach ($details as $detail)
                                            <div class="form-group">
                                                <label for="{{ $detail->detailname }}">{{ $detail->detailname }}</label>

                                                {{-- @if ($detail->detailtype == 'radio')
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="1"
                                                            name="{{ $detail->propertytypedetailsid }}"
                                                            id="yes{{ $detail->propertytypedetailsid }}">
                                                        <label class="form-check-label"
                                                            for="yes{{ $detail->propertytypedetailsid }}">
                                                            نعم
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" value="0"
                                                            name="{{ $detail->propertytypedetailsid }}"
                                                            id="no{{ $detail->propertytypedetailsid }}" checked>
                                                        <label class="form-check-label"
                                                            for="no{{ $detail->propertytypedetailsid }}">
                                                            لا
                                                        </label>
                                                    </div>
                                                @elseif ($detail->detailtype == 'number')
                                                    <input id="{{ $detail->detailname }}" type="number"
                                                        class="form-control @error('{{ $detail->detailname }}') is-invalid @enderror"
                                                        name="{{ $detail->propertytypedetailsid }}"
                                                        value="{{ old('$detail->propertytypedetailsid') }}"
                                                        autocomplete="{{ $detail->detailname }}">
                                                @else --}}
                                                    <input id="{{ $detail->detailname }}" type="text"
                                                        class="form-control @error('{{ $detail->detailname }}') is-invalid @enderror"
                                                        name="{{ $detail->propertytypedetailsid }}"
                                                        value="{{ old('$detail->propertytypedetailsid') }}"
                                                        autocomplete="{{ $detail->detailname }}">
                                                {{-- @endif --}}


                                                @error('{{ $detail->detailname }}')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        @endforeach

                                        <hr>
                                        <h3>حقول إضافية</h3>


                                        <div> <button type="button" onclick="add_extra()" class="btn btn-primary my-2">
                                                حقل جديد<i class="fa fa-plus "></i></button></div>
                                        <div id="extra">

                                        </div>

                                        <button type="submit" id="submit" style="float: right;"
                                            class="btn btn-primary">حفظ</button>

                                    </form>
                                </div>
                                <!-- /.card-body -->
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



        initMap();
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

        });


        function show_citys(e) {
            id = $(e).val();
            //alert(id);
            console.log(id);
            get_url = "{{ route('admin.cars.cityByCountry', ['id' => 'sid']) }}";
            get_url = get_url.replace("sid", id);
            $.ajax({
                type: 'GET',
                url: get_url,
                data: {
                    id: id
                },
                success: function(data) {
                    console.log(data);
                    if (data == '') {
                        var st = '<option  hidden >لايوجد مدن مضافةلهذا البلد</option>';
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
        var f_count = 0;
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
            console.log(field_el.parentNode.parentNode);
            $(field_el.parentNode.parentNode).remove();
        }
    </script>
@endpush
