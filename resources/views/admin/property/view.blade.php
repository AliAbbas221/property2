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
                                    <form>

                                        <input type="hidden" value="{{ $property->propertyId }}" name="id">
                                        <div class="form-group">
                                            <label for="cartitle">مالك المنشور</label>
                                            <a href="{{route('admin.users.view',['id'=>$property->owner->ownerId])}}"
                                                 class="form-control  " style=" background-color: #eee;">
                                                {{ $property->owner->firstname . ' ' . $property->owner->lastname }}</a>

                                        </div>
                                        <div class="form-group">
                                            <label for="title">عنوان المنشور</label>
                                            <input type="text" class="form-control  @error('title') is-invalid @enderror"
                                                name="title" id="title" value="{{ old('title', $property->title) }}"
                                                disabled>

                                        </div>

                                        <div class="form-group">
                                            <label for="typeid">نوع العقار</label>
                                            <select class="form-control @error('typeid') is-invalid @enderror"
                                                name="typeid" id="typeid" disabled>

                                                <option value="" hidden></option>
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->property_type_id }}"
                                                        @selected($type->property_type_id == $property->propertyTypeId)>{{ $type->typename }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <label for="registration">نوع التسجيل</label>
                                            <select class="form-control @error('registration') is-invalid @enderror"
                                                name="registration" id="registration" disabled>

                                                <option value="" hidden></option>
                                                @foreach ($registrations as $registration)
                                                    <option value="{{ $registration->property_regestration_type_id }}"
                                                        @selected($registration->property_regestration_type_id == $property->property_regestration_type_id)>
                                                        {{ $registration->name }}
                                                    </option>
                                                @endforeach
                                            </select>


                                        </div>

                                        <div class="form-group">
                                            <label for="operationtypeid">نوع العملية</label>
                                            <select class="form-control @error('operationtypeid') is-invalid @enderror"
                                                name="operationtypeid" id="operationtypeid" disabled>

                                                <option value="" hidden></option>
                                                @foreach ($operations as $operation)
                                                    <option value="{{ $operation->propertyoperationtypeid }}"
                                                        @selected($operation->propertyoperationtypeid == $property->operationTypeId)>
                                                        {{ $operation->operationtypename }}</option>
                                                @endforeach
                                            </select>

                                        </div>


                                        <div class="form-group row">
                                            <div class="col-10"> <label for="price">السعر</label>
                                                <input type="number" id="price" name="price" min="0"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    value="{{ old('price', $property->price) }}" autocomplete="price"
                                                    disabled>


                                            </div>
                                            <div class="">
                                                <label for="currency">العملة</label>
                                                <select class="form-control @error('currency') is-invalid @enderror"
                                                    name="currency" id="currency" disabled>

                                                    <option value="" hidden></option>
                                                    @foreach ($currencys as $currency)
                                                        <option value="{{ $currency->currency_name }}"
                                                            @selected($currency->currency_name == $property->currency)>
                                                            {{ $currency->currency_name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="location">الموقع</label>
                                            <input type="text"
                                                class="form-control  @error('location') is-invalid @enderror"
                                                name="location" id="location"
                                                value="{{ old('location', $property->location) }}" disabled>


                                        </div>

                                        <div class="form-group">

                                            @php
                                                if ($property->coordinates) {
                                                    $coord = explode(',', $property->coordinates);
                                                } else {
                                                    $coord = '34.7324,36.7137';
                                                    $coord = explode(',', $coord);
                                                }
                                                
                                            @endphp

                                            <label for="coordinates">الإحداثيات</label>
                                            @if (!$property->coordinates)
                                                <h6>لم يتم إدخال الإحداثيات</h6>
                                            @else
                                                <div id='map' class='form-control img-fluid'
                                                    style='height:300px; width:100%;'></div>
                                                <input id="lat" type="text" name="coordinates[]"
                                                    value="{{ $coord[0] }}" style="  opacity: 0; width: 0;"
                                                    oninvalid="this.setCustomValidity('ادخل موقع العقار')">
                                                <input id="long" type="text" name="coordinates[]"
                                                    value="{{ $coord[1] }}" style="  opacity: 0; width: 0;"
                                                    oninvalid="this.setCustomValidity('ادخل موقع العقار')">
                                            @endif


                                        </div>

                                        <div class="form-group">
                                            <label for="areasize">المساحة</label>
                                            <input type="number"
                                                class="form-control  @error('areasize') is-invalid @enderror"
                                                name="areasize" id="areasize"
                                                value="{{ old('areasize', $property->areasize) }}" disabled>


                                        </div>

                                        <div class="form-group">
                                            <label for="status">الحالة</label>
                                            <input type="text"
                                                class="form-control  @error('status') is-invalid @enderror" name="status"
                                                id="status" value="{{ old('status', $property->status) }}" disabled>



                                        </div>


                                        <div class="form-group">
                                            <label for="mainphoto">الصورة الرئيسية</label>
                                            {{-- <input type="file"
                                                class="form-control-file @error('mainphoto') is-invalid @enderror"
                                                name="mainphoto" id="mainphoto" accept="image/*"> --}}
                                            <br>
                                            @if ($property->mainPhoto)
                                                <img src="{{ $property->mainPhoto }}" id="c_display" height='200'
                                                    width='250' />
                                            @else
                                                <h6>لا يوجد</h6>
                                            @endif

                                            <br>



                                        </div>

                                        <div class="form-group">
                                            <label for="attachment">صور إضافية</label>


                                            <br>

                                            <div class="row">
                                                @if ($property->attatchments)
                                                    @foreach ($property->attatchments as $attach)
                                                        <div class="images mx-1"
                                                            id="img{{ $attach->propertyattachmentsid }}">
                                                            <img class="attachment" src="{{ $attach->url }}"
                                                                id="" height='100' width='150'
                                                                style="" />
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <h6>لا يوجد</h6>
                                                @endif


                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="notes">ملاحظات</label>
                                            <textarea class="form-control  @error('notes') is-invalid @enderror" name="notes" id="notes" disabled>{{ old('notes', $property->notes) }}</textarea>



                                        </div>



                                        <div class="form-group">
                                            <label for="country">البلد</label>
                                            <select class="form-control @error('country') is-invalid @enderror"
                                                name="country" id="country" onchange="show_citys(this)" disabled>

                                                <option value="" hidden></option>
                                                @foreach ($countrys as $country)
                                                    <option value="{{ $country->id }}" @selected($ccountry->id == $country->id)>
                                                        {{ $country->country_name }}
                                                    </option>
                                                @endforeach
                                            </select>


                                        </div>

                                        <div class="form-group">
                                            <label for="city">المدينة</label>
                                            <select class="form-control @error('city') is-invalid @enderror"
                                                name="city" id="city" disabled>
                                                @foreach ($citys as $city)
                                                    <option value="{{ $city->cityId }}" @selected($city->cityId == $property->cityId)>
                                                        {{ $city->name }}
                                                    </option>
                                                @endforeach

                                            </select>



                                        </div>



                                        <hr>

                                        <h3>تفاصيل العقار</h3>

                                        @if (!$property->details->isEmpty())
                                            @foreach ($property->details as $key => $detail)
                                                <div class="form-group">
                                                    <label
                                                        for="{{ $detail->detailname }}">{{ $detail->detailname }}</label>


                                                    <input id="{{ $detail->detailname }}" type="text"
                                                        class="form-control @error('{{ $detail->detailname }}') is-invalid @enderror"
                                                        name="{{ $detail->propertytypedetailsid }}"
                                                        value="{{ old('$detail->propertytypedetailsid', $property->details[$key]->pivot->detailvalue) }}"
                                                        disabled>

                                                </div>
                                            @endforeach
                                        @else
                                            <h6>لا يوجد</h6>
                                        @endif
                                        <hr>
                                        <h3>حقول إضافية</h3>



                                        <div id="extra">
                                            <input type="hidden" name="del_field" id="del_field">
                                            @foreach ($fields as $field)
                                                <div>
                                                    <div class="form-group" id="field{{ $field->fieldid }}">

                                                        <label for="city">اسم الحقل</label>
                                                        <input type="text"
                                                            class="form-control  @error('labels[]') is-invalid @enderror"
                                                            name="labels[]" id="labels[]"
                                                            value="{{ $field->fieldname }}" disabled>
                                                        <label for="city">قيمة الحقل</label>
                                                        <input type="text"
                                                            class="form-control  @error('values[]') is-invalid @enderror"
                                                            name="values[]" id="values[]"
                                                            value="{{ $field->fieldvalue }}" disabled>
                                                    </div>

                                                </div>
                                            @endforeach
                                            @if ($fields->isEmpty())
                                                <h6>لا يوجد</h6>
                                            @endif

                                        </div>

                                        <hr>


                                        <button type="button" onclick="location.href='/property'" style="float: right;"
                                            class="btn btn-primary">رجوع</button>

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
    <script type="text/javascript">
        $(document).ready(function() {
            //get coord
            var clinic_lat = $("#lat").val();
            var clinic_lng = $("#long").val();



            let map;
            const pos = {
                lat: parseFloat(clinic_lat),
                lng: parseFloat(clinic_lng)
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
                    mapId: "خريطة",
                    scrollwheel: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    disableDefaultUI: true,
                    zoomControl: true,
                    fullscreenControl: true,
                });



                // The marker, positioned at the clinic
                const marker = new google.maps.Marker({
                    map: map,
                    position: pos,
                    title: "الموقع",
                    draggable: true,

                });
                google.maps.event.addListener(marker, 'dragend', function(marker) {
                    clinic_pos = marker.latLng;

                    $('#lat').val(clinic_pos.lat());
                    $('#long').val(clinic_pos.lng());

                    // alert($('#lat_add').val());
                    // alert($('#long_add').val());
                });
            }
            initMap();
        });
    </script>
@endpush
