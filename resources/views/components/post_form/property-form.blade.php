<div class="card">
    <div class="card-header">
        <h3 class="card-title"></h3>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="{{ route('admin.property.create') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
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

                    
                        <input id="{{ $detail->detailname }}" type="text"
                            class="form-control @error('{{ $detail->detailname }}') is-invalid @enderror"
                            name="{{ $detail->propertytypedetailsid }}"
                            value="{{ old('$detail->propertytypedetailsid') }}"
                            autocomplete="{{ $detail->detailname }}">
                   

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