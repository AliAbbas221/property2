@extends('layouts.admin.main')


@section('content')
    <style>
        img.attachment {
            /* cursor: pointer; */
            border-radius: 5px;
            transition: .5s ease;
        }

        img.attachment:hover {
            opacity: 0.3;

        }

        .images:hover {}

        .images:hover .close {
            display: block;
        }

        .close {
            cursor: pointer;
            position: absolute;
            /* top: 0; */
            /* right: 5%; */
            color: #dc3545;
            font-size: 25px;
            font-weight: bold;
            transition: 0.3s;
            float: right;
            display: none;
            z-index: 1;

        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;

        }
    </style>
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
                                    <form action="{{ route('admin.items.update') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" value="{{ $item->useditemsid }}" name="id">
                                        <div class="form-group">
                                            <label for="title">عنوان المنشور</label>
                                            <input type="text" class="form-control  @error('title') is-invalid @enderror"
                                                name="title" id="title" value="{{ old('title', $item->title) }}"
                                                pattern=".{4,}">
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="typeid ">نوع الغرض</label>
                                            <select class="form-control @error('typeid') is-invalid @enderror"
                                                name="typeid" id="typeid">

                                                <option value="" hidden></option>
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->useditemtypeid }}"
                                                        @selected($type->useditemtypeid == $item->itemtypeid)>{{ $type->usedtypename }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('typeid')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-10"> <label for="price">السعر</label>
                                                <input type="number" id="price" name="price" min="0"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    value="{{ old('price', $item->price) }}" autocomplete="price">

                                                @error('price')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="">
                                                <label for="currency">العملة</label>
                                                <select class="form-control @error('r') is-invalid @enderror"
                                                    name="currency" id="currency" required>

                                                    <option value="" hidden></option>
                                                    @foreach ($currencys as $currency)
                                                        <option value="{{ $currency->currency_name }}"
                                                            @selected($currency->currency_name == $item->currency)>
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
                                            <label for="dimensions">الأبعاد</label>
                                            <input type="text"
                                                class="form-control  @error('dimensions') is-invalid @enderror"
                                                name="dimensions" id="dimensions"
                                                value="{{ old('dimensions', $item->dimensions) }}" pattern="{4,}">
                                            @error('dimensions')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description">الوصف</label>
                                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">
                                                {{ old('description', $item->description) }}
                                            
                                            </textarea>

                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>



                                        <div class="form-group">
                                            <label for="mainphoto">الصورة الرئيسية</label>
                                            {{-- <input type="file"
                                                class="form-control-file @error('mainphoto') is-invalid @enderror"
                                                name="mainphoto" id="mainphoto" accept="image/*"> --}}

                                            <input type="file" class="form-control" name="mainphoto" id="mainphoto"
                                                onChange="displayImage_car(this)" style="display: none;border-radius: 5px;"
                                                accept="image/*">
                                            <br>
                                            <img src="{{ $item->mainphoto }}" onClick="triggerClick_car()" id="c_display"
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
                                            {{-- {{$item->attatchments }} --}}
                                            <div class="row">
                                                @foreach ($item->attatchments as $attach)
                                                    <div class="images mx-1"
                                                        id="img{{ $attach->useditem_attachments_id }}">
                                                        <span class="close mx-2"
                                                            onclick="delete_image(this,{{ $attach->useditem_attachments_id }})">&times;</span>
                                                        <img class="attachment" src="{{ $attach->url }}" id=""
                                                            height='100' width='150' style="" />
                                                    </div>
                                                    <div>
                                                        <button type="button" class="back btn btn-secondary d-none mx-1"
                                                            id="back{{ $attach->useditem_attachments_id }}"
                                                            onclick="undelete_image({{ $attach->useditem_attachments_id }})">
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
                                                    <option value="{{ $city->cityId }}" @selected($city->cityId == $item->cityid)>
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
