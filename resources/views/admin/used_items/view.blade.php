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
                                        <div class="form-group">
                                            <label for="cartitle">مالك المنشور</label>
                                            <a href="{{ route('admin.users.view', ['id' => $item->owner->ownerId]) }}"
                                                class="form-control  " style=" background-color: #eee;">
                                                {{ $item->owner->firstname . ' ' . $item->owner->lastname }}</a>

                                        </div>
                                        <div class="form-group">
                                            <label for="title">عنوان المنشور</label>
                                            <input type="text" class="form-control  @error('title') is-invalid @enderror"
                                                name="title" id="title" value="{{ old('title', $item->title) }}"
                                                disabled>
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="typeid ">نوع الغرض</label>
                                            <select class="form-control @error('typeid') is-invalid @enderror"
                                                name="typeid" id="typeid" disabled>

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
                                                    value="{{ old('price', $item->price) }}" disabled>

                                                @error('price')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="">
                                                <label for="currency">العملة</label>
                                                <select class="form-control @error('r') is-invalid @enderror"
                                                    name="currency" id="currency" disabled>

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
                                                value="{{ old('dimensions', $item->dimensions) }}" disabled>
                                            @error('dimensions')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="description">الوصف</label>
                                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" disabled>
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
                                            <br>
                                            <img src="{{ $item->mainphoto }}" id="c_display" height='200'
                                                width='250' />


                                            @error('mainphoto')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="mainphoto">صور إضافية</label>

                                            <div class="row">
                                                @foreach ($item->attatchments as $attach)
                                                    <div class="images mx-1"
                                                        id="img{{ $attach->useditem_attachments_id }}">

                                                        <img class="attachment" src="{{ $attach->url }}" id=""
                                                            height='100' width='150' style="" />
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
                                                    <option value="{{ $city->cityId }}" @selected($city->cityId == $item->cityid)>
                                                        {{ $city->name }}
                                                    </option>
                                                @endforeach

                                            </select>


                                        </div>



                                        <button type="button" onclick="location.href='/items'" style="float: right;"
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
