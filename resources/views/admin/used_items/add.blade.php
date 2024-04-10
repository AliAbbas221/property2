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
                                    <form action="{{ route('admin.items.create') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="title">عنوان المنشور</label>
                                            <input type="text"
                                                class="form-control  @error('title') is-invalid @enderror"
                                                name="title" id="title" value="{{ old('title') }}" pattern="{4,}">
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
                                                    <option value="{{ $type->useditemtypeid }}">{{ $type->usedtypename }}
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
                                                    value="{{ old('price') }}" autocomplete="price">

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
                                            <label for="dimensions">الأبعاد</label>
                                            <input type="text"
                                                class="form-control  @error('dimensions') is-invalid @enderror"
                                                name="dimensions" id="dimensions" value="{{ old('dimensions') }}"
                                                pattern="{4,}">
                                            @error('dimensions')
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
                                            <label for="description">الوصف</label>
                                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description">
                                               {{ old('description') }}
                                            
                                            </textarea>

                                            @error('description')
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
                                            <select class="form-control @error('city') is-invalid @enderror" name="city"
                                                id="city" required disabled>


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
    </script>
@endpush
