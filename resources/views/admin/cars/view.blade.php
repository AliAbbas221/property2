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

                                        <input type="hidden" value="{{ $car->carid }}" name="id">
                                        <div class="form-group">
                                            <label for="cartitle">مالك المنشور</label>
                                            <a href="{{route('admin.users.view',['id'=>$car->owner->ownerId])}}"
                                                 class="form-control  " style=" background-color: #eee;">
                                                {{ $car->owner->firstname . ' ' . $car->owner->lastname }}</a>

                                        </div>
                                        <div class="form-group">
                                            <label for="cartitle">عنوان المنشور</label>
                                            <input type="text"
                                                class="form-control  @error('cartitle') is-invalid @enderror"
                                                name="cartitle" id="cartitle" value="{{ old('cartitle', $car->cartitle) }}"
                                                pattern=".{4,}" disabled>

                                        </div>

                                        <div class="form-group">
                                            <label for="cartypeid ">نوع السيارة</label>
                                            <select class="form-control @error('cartypeid') is-invalid @enderror"
                                                name="cartypeid" id="cartypeid" disabled>

                                                <option value="" hidden></option>
                                                @foreach ($types as $type)
                                                    <option value="{{ $type->cartypeid }}" @selected($type->cartypeid == $car->cartypeid)>
                                                        {{ $type->typename }}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <label for="manufacture">المصنع</label>
                                            <select class="form-control @error('manufacture') is-invalid @enderror"
                                                name="manufacture" id="manufacture" disabled>


                                                @foreach ($manufactures as $manufacture)
                                                    <option value="{{ $manufacture->carmanufactureid }}"
                                                        @selected($manufacture->carmanufactureid == $car->carmanufactureid)>
                                                        {{ $manufacture->companyname }}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <label for="model">الإصدار</label>
                                            <select class="form-control @error('model') is-invalid @enderror" name="model"
                                                id="model" disabled>

                                                @foreach ($models as $model)
                                                    <option value="{{ $model->carmodelid }}" @selected($model->carmodelid == $car->modelid)>
                                                        {{ $model->modelname }}</option>
                                                @endforeach

                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <label for="manufactureyear">سنة التصنيع</label>
                                            <input type="number" id="manufactureyear" name="manufactureyear"
                                                class="form-control @error('manufactureyear') is-invalid @enderror"
                                                value="{{ old('manufactureyear', $car->manufactureyear) }}" disabled>


                                        </div>

                                        <div class="form-group">
                                            <label for="registeryear">سنة التسجيل</label>
                                            <input type="number" id="registeryear" name="registeryear" min="1950"
                                                max="{{ now()->year }}"
                                                class="form-control @error('registeryear') is-invalid @enderror"
                                                value="{{ old('registeryear', $car->registeryear) }}" disabled>


                                        </div>

                                        <div class="form-group">
                                            <label for="km">الكيلومترات المقطوعة</label>
                                            <input type="number" id="km" name="km" min="0"
                                                max="320,000" class="form-control @error('km') is-invalid @enderror"
                                                value="{{ old('km', $car->km) }}" disabled>

                                        </div>

                                        <div class="form-group row">
                                            <div class="col-10"> <label for="price">السعر</label>
                                                <input type="number" id="price" name="price" min="0"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    value="{{ old('price', $car->price) }}" disabled>


                                            </div>
                                            <div class="">
                                                <label for="currency">العملة</label>
                                                <select class="form-control @error('r') is-invalid @enderror"
                                                    name="currency" id="currency" disabled>

                                                    <option value="" hidden></option>
                                                    @foreach ($currencys as $currency)
                                                        <option value="{{ $currency->currency_name }}"
                                                            @selected($currency->currency_name == $car->currency)>
                                                            {{ $currency->currency_name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <label for="mainphoto">الصورة الرئيسية</label>
                                            {{-- <input type="file"
                                                class="form-control-file @error('mainphoto') is-invalid @enderror"
                                                name="mainphoto" id="mainphoto" accept="image/*"> --}}

                                            <br>
                                            <img src="{{ $car->mainphoto }}" onClick="triggerClick_car()" id="c_display"
                                                height='200' width='250' style="border-radius: 5px;" />


                                        </div>

                                        <div class="form-group">
                                            <label for="mainphoto">صور إضافية</label>

                                            <br>
                                            {{-- {{ $car->attatchments }} --}}
                                            <div class="row">
                                                @foreach ($car->attatchments as $attach)
                                                    <div class="images mx-1" id="img{{ $attach->carattachmentsid }}">
                                                        <img class="attachment" src="{{ $attach->attachmentlink }}"
                                                            id="" height='100' width='150'
                                                            style="" />
                                                    </div>
                                                @endforeach

                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label for="description">الوصف</label>
                                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"
                                                disabled>
                                              
                                               {{ old('description', $car->descriptions) }}
                                            </textarea>

                                        </div>

                                        <div class="form-group">
                                            <label for="operation">نوع العملية</label>
                                            <select class="form-control @error('operation') is-invalid @enderror"
                                                name="operation" id="operation" disabled>

                                                <option value="" hidden></option>
                                                @foreach ($operations as $operation)
                                                    <option value="{{ $operation->caroperationtypeid }}"
                                                        @selected($operation->caroperationtypeid === $car->operationtypeid)>
                                                        {{ $operation->operationtype }}
                                                    </option>
                                                @endforeach
                                            </select>


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
                                                    <option value="{{ $city->cityId }}" @selected($city->cityId == $car->cityid)>
                                                        {{ $city->name }}
                                                    </option>
                                                @endforeach

                                            </select>


                                        </div>

                                        <div class="form-group">
                                            <label for="address">العنوان</label>
                                            <input id="address" type="text"
                                                class="form-control @error('address') is-invalid @enderror"
                                                name="address" value="{{ old('address', $car->address) }}" disabled>


                                        </div>

                                        <hr>

                                        <h3>تفاصيل السيارة</h3>
                                        @if (!$car->details->isEmpty())
                                            @foreach ($car->details as $key => $detail)
                                                <div class="form-group">
                                                    <label
                                                        for="{{ $detail->detailsname }}">{{ $detail->detailsname }}</label>


                                                    <input id="{{ $detail->detailsname }}" type="text"
                                                        class="form-control @error('{{ $detail->detailsname }}') is-invalid @enderror"
                                                        name="{{ $detail->detailsid }}"
                                                        value="{{ old($detail->detailsid, $car->details[$key]->pivot->value) }}"
                                                        disabled>




                                                </div>
                                                @error('{{ $detail->detailsname }}')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            @endforeach
                                        @else
                                            <h6>لا يوجد</h6>
                                        @endif



                                        <button type="button" onclick="location.href='/cars'" style="float: right;"
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
