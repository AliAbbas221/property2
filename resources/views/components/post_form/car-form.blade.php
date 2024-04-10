<div class="card">
    <div class="card-header">
        <h3 class="card-title"></h3>

    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="{{ route('admin.cars.create') }}" method="post" enctype="multipart/form-data">
           
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">
            <div class="form-group">
                <label for="cartitle">عنوان المنشور</label>
                <input type="text" class="form-control  @error('cartitle') is-invalid @enderror" name="cartitle"
                    id="cartitle" value="{{ old('cartitle') }}" pattern="{4,}">
                @error('cartitle')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="cartypeid ">نوع السيارة</label>
                <select class="form-control @error('cartypeid') is-invalid @enderror" name="cartypeid" id="cartypeid">

                    <option value="" hidden></option>
                    @foreach ($types as $type)
                        <option value="{{ $type->cartypeid }}">{{ $type->typename }}</option>
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
                <select class="form-control @error('manufacture') is-invalid @enderror" name="manufacture"
                    id="manufacture" onchange="show_models(this)" required>

                    <option value="" hidden></option>
                    @foreach ($manufactures as $manufacture)
                        <option value="{{ $manufacture->carmanufactureid }}">
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
                <select class="form-control @error('model') is-invalid @enderror" name="model" id="model"
                    disabled>

                    <option value="" hidden></option>

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
                    max="{{ now()->year }}" class="form-control @error('manufactureyear') is-invalid @enderror"
                    value="{{ old('manufactureyear') }}" autocomplete="manufactureyear">

                @error('manufactureyear')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="registeryear">سنة التسجيل</label>
                <input type="number" id="registeryear" name="registeryear" min="1950" max="{{ now()->year }}"
                    class="form-control @error('registeryear') is-invalid @enderror" value="{{ old('registeryear') }}"
                    autocomplete="registeryear">

                @error('registeryear')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="km">الكيلومترات المقطوعة</label>
                <input type="number" id="km" name="km" min="0" max="320,000"
                    class="form-control @error('km') is-invalid @enderror" value="{{ old('km') }}"
                    autocomplete="km">

                @error('km')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group row">
                <div class="col-10"> <label for="price">السعر</label>
                    <input type="number" id="price" name="price" min="0"
                        class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}"
                        autocomplete="price">

                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="">
                    <label for="currency">العملة</label>
                    <select class="form-control @error('r') is-invalid @enderror" name="currency" id="currency">

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
                <label for="mainphoto">الصورة الرئيسية</label>
                <input type="file" class="form-control-file @error('mainphoto') is-invalid @enderror"
                    name="mainphoto" id="mainphoto" accept="image/*">

                @error('mainphoto')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="mainphoto">صور إضافية</label>
                <input type="file" class="form-control-file @error('attachment') is-invalid @enderror"
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
                <label for="operation">نوع العملية</label>
                <select class="form-control @error('operation') is-invalid @enderror" name="operation"
                    id="operation">

                    <option value="" hidden></option>
                    @foreach ($operations as $operation)
                        <option value="{{ $operation->caroperationtypeid }}">
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
                <select class="form-control @error('country') is-invalid @enderror" name="country" id="country"
                    onchange="show_citys(this)" required>

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
                <select class="form-control @error('city') is-invalid @enderror" name="city" id="city"
                    disabled required>


                </select>
                @error('city')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="form-group">
                <label for="address">العنوان</label>
                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror"
                    name="address" value="{{ old('address') }}" autocomplete="address">

                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <hr>

            <h3>تفاصيل السيارة</h3>

            @foreach ($details as $detail)
                <div class="form-group">
                    <label for="{{ $detail->detailsname }}">{{ $detail->detailsname }}</label>

                  
                        <input id="{{ $detail->detailsname }}" type="text"
                            class="form-control @error('{{ $detail->detailsname }}') is-invalid @enderror"
                            name="{{ $detail->detailsid }}" value="{{ old('$detail->detailsid') }}"
                            autocomplete="{{ $detail->detailsname }}">
                    


                    @error('{{ $detail->detailsname }}')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            @endforeach




            <button type="submit" id="submit" style="float: right;" class="btn btn-primary">حفظ</button>

        </form>
    </div>
</div>
