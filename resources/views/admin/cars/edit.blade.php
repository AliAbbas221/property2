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
                                    <form action="{{ route('admin.cars.update') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $car->carid }}" name="id">
                                        <div class="form-group">
                                            <label for="cartitle">عنوان المنشور</label>
                                            <input type="text"
                                                class="form-control  @error('cartitle') is-invalid @enderror"
                                                name="cartitle" id="cartitle" value="{{ old('cartitle', $car->cartitle) }}"
                                                pattern=".{4,}">
                                            @error('cartitle')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="cartypeid ">نوع السيارة</label>
                                            <select class="form-control @error('cartypeid') is-invalid @enderror"
                                                name="cartypeid" id="cartypeid">

                                                <option value="" hidden></option>
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->cartypeid }}" @selected($type->cartypeid == $car->cartypeid)>
                                                        {{ $type->typename }}</option>
                                                @endforeach
                                            </select>
                                            @error('cartypeid')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="manufacture">المصنع</label>
                                            <select class="form-control @error('manufacture') is-invalid @enderror"
                                                name="manufacture" id="manufacture" onchange="show_models(this)" required>


                                                @foreach ($manufactures as $manufacture)
                                                    <option value="{{ $manufacture->carmanufactureid }}"
                                                        @selected($manufacture->carmanufactureid == $car->carmanufactureid)>
                                                        {{ $manufacture->companyname }}</option>
                                                @endforeach
                                            </select>
                                            @error('manufacture')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="model">الإصدار</label>
                                            <select class="form-control @error('model') is-invalid @enderror" name="model"
                                                id="model">

                                                @foreach ($models as $model)
                                                    <option value="{{ $model->carmodelid }}" @selected($model->carmodelid == $car->modelid)>
                                                        {{ $model->modelname }}</option>
                                                @endforeach

                                            </select>
                                            @error('model')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="manufactureyear">سنة التصنيع</label>
                                            <input type="number" id="manufactureyear" name="manufactureyear" min="1900"
                                                max="{{ now()->year }}"
                                                class="form-control @error('manufactureyear') is-invalid @enderror"
                                                value="{{ old('manufactureyear', $car->manufactureyear) }}"
                                                autocomplete="manufactureyear">

                                            @error('manufactureyear')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="registeryear">سنة التسجيل</label>
                                            <input type="number" id="registeryear" name="registeryear" min="1950"
                                                max="{{ now()->year }}"
                                                class="form-control @error('registeryear') is-invalid @enderror"
                                                value="{{ old('registeryear', $car->registeryear) }}"
                                                autocomplete="registeryear">

                                            @error('registeryear')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="km">الكيلومترات المقطوعة</label>
                                            <input type="number" id="km" name="km" min="0"
                                                max="320,000" class="form-control @error('km') is-invalid @enderror"
                                                value="{{ old('km', $car->km) }}" autocomplete="km">

                                            @error('km')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-10"> <label for="price">السعر</label>
                                                <input type="number" id="price" name="price" min="0"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    value="{{ old('price', $car->price) }}" autocomplete="price">

                                                @error('price')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="">
                                                <label for="currency">العملة</label>
                                                <select class="form-control @error('r') is-invalid @enderror"
                                                    name="currency" id="currency">

                                                    <option value="" hidden></option>
                                                    @foreach ($currencys as $currency)
                                                        <option value="{{ $currency->currency_name }}"
                                                            @selected($currency->currency_name == $car->currency)>
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
                                            <label for="mainphoto">الصورة الرئيسية</label>
                                            {{-- <input type="file"
                                                class="form-control-file @error('mainphoto') is-invalid @enderror"
                                                name="mainphoto" id="mainphoto" accept="image/*"> --}}

                                            <input type="file" class="form-control" name="mainphoto" id="mainphoto"
                                                onChange="displayImage_car(this)"
                                                style="display: none;border-radius: 5px;" accept="image/*">
                                            <br>
                                            <img src="{{ $car->mainphoto }}" onClick="triggerClick_car()" id="c_display"
                                                height='200' width='250' style=" cursor: pointer;" />

                                            @error('mainphoto')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="mainphoto">صور إضافية</label>
                                            <input type="file"
                                                class="attachment form-control-file @error('attachment') is-invalid @enderror"
                                                name="attachment[]" id="attachment" accept="image/*" multiple>
                                            <br>
                                            {{-- {{ $car->attatchments }} --}}
                                            <div class="row">
                                                @foreach ($car->attatchments as $attach)
                                                    <div class="images mx-1" id="img{{ $attach->carattachmentsid }}">
                                                        <span class="close mx-2"
                                                            onclick="delete_image(this,{{ $attach->carattachmentsid }})">&times;</span>
                                                        <img class="attachment" src="{{ $attach->attachmentlink }}"
                                                            id="" height='100' width='150'
                                                            style="" />
                                                    </div>
                                                    <div>
                                                        <button type="button" class="back btn btn-secondary d-none mx-1"
                                                            id="back{{ $attach->carattachmentsid }}"
                                                            onclick="undelete_image({{ $attach->carattachmentsid }})">
                                                            تراجع</button>
                                                    </div>
                                                @endforeach
                                                <input type="hidden" name="del_img" id="del_img">
                                            </div>
                                            @error('attachment')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description">الوصف</label>
                                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">
                                              
                                               {{ old('description', $car->descriptions) }}
                                            </textarea>

                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="operation">نوع العملية</label>
                                            <select class="form-control @error('operation') is-invalid @enderror"
                                                name="operation" id="operation">

                                                <option value="" hidden></option>
                                                @foreach ($operations as $operation)
                                                    <option value="{{ $operation->caroperationtypeid }}"
                                                        @selected($operation->caroperationtypeid === $car->operationtypeid)>
                                                        {{ $operation->operationtype }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('operation')
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
                                                    <option value="{{ $country->id }}" @selected($ccountry->id == $country->id)>
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
                                                name="city" id="city">
                                                @foreach ($citys as $city)
                                                    <option value="{{ $city->cityId }}" @selected($city->cityId == $car->cityid)>
                                                        {{ $city->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                        <div class="form-group">
                                            <label for="address">العنوان</label>
                                            <input id="address" type="text"
                                                class="form-control @error('address') is-invalid @enderror"
                                                name="address" value="{{ old('address', $car->address) }}"
                                                autocomplete="address">

                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <hr>

                                        <h3>تفاصيل السيارة</h3>
                                        @if (!$car->details->isEmpty())
                                            @foreach ($car->details as $key => $detail)
                                                <div class="form-group">
                                                    <label
                                                        for="{{ $detail->detailsname }}">{{ $detail->detailsname }}</label>

                                                    {{-- @if ($detail->detailstype == 'radio')
                                                        <div class="form-check">

                                                            <input class="form-check-input" type="radio" value="1"
                                                                name="{{ $detail->detailsid }}"
                                                                id="yes{{ $detail->detailsid }}"
                                                                @checked(1 == $car->details[$key]->pivot->value)>
                                                            <label class="form-check-label"
                                                                for="yes{{ $detail->detailsid }}">
                                                                نعم
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" value="0"
                                                                name="{{ $detail->detailsid }}"
                                                                id="no{{ $detail->detailsid }}"
                                                                @checked(0 == $car->details[$key]->pivot->value)>
                                                            <label class="form-check-label"
                                                                for="no{{ $detail->detailsid }}">
                                                                لا
                                                            </label>
                                                        </div>
                                                    @elseif ($detail->detailstype == 'number')
                                                        <input id="{{ $detail->detailsname }}" type="number"
                                                            class="form-control @error('{{ $detail->detailsname }}') is-invalid @enderror"
                                                            name="{{ $detail->detailsid }}"
                                                            value="{{ old($detail->detailsid, $car->details[$key]->pivot->value) }}"
                                                            autocomplete="{{ $detail->detailsname }}">
                                                    @else --}}
                                                        <input id="{{ $detail->detailsname }}" type="text"
                                                            class="form-control @error('{{ $detail->detailsname }}') is-invalid @enderror"
                                                            name="{{ $detail->detailsid }}"
                                                            value="{{ old($detail->detailsid, $car->details[$key]->pivot->value) }}"
                                                            autocomplete="{{ $detail->detailsname }}">
                                                    {{-- @endif --}}


                                                    @error('{{ $detail->detailsname }}')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @endforeach
                                        @else
                                            <h6>لا يوجد</h6>
                                        @endif


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
@push('scripts')
    <script type="text/javascript">
        var img_id = [];
        $(document).ready(function() {

        });

        function show_models(e) {
            id = $(e).val();
            //alert(id);
            console.log(id);
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
                        var st = '<option  hidden >There are no models for this manufacture</option>';
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
                        var st = '<option  hidden >There are no cities for this country</option>';
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

        //for update clinic photo in edit modal
        {
            function triggerClick_car(e) {
                document.querySelector('#mainphoto').click();
            }

            function displayImage_car(e) {
                if (e.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.querySelector('#c_display').setAttribute('src', e.target.result);
                    }
                    reader.readAsDataURL(e.files[0]);
                }
            }
        }

        function delete_image(img_el, id) {
            // alert(id);
            back = '#back' + id;
            //alert(back);
            // console.log(img_el.parentNode);
            if (img_id.indexOf(id) === -1) {
                img_id.push(id);
            }
            // img_id.push(id);
            // alert(img_id);
            $('#del_img').val(img_id);
            $(img_el.parentNode).addClass('d-none');
            $(back).removeClass('d-none');
        }

        function undelete_image(id) {
            // alert(id);
            img = '#img' + id;
            back = '#back' + id;


            for (i in img_id) {
                if (img_id[i] == id) {
                    img_id.splice(i, 1);
                    break;
                }
            }


            //alert(img_id);

            $('#del_img').val(img_id);

            $(img).removeClass('d-none');

            $(back).addClass('d-none');

        }
    </script>
@endpush
