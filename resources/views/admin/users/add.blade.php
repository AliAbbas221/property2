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
                                    <form action="{{ route('admin.users.create') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="firstname"> الاسم الأول<span class="required">*</span></label>
                                            <input type="text"
                                                class="form-control  @error('firstname') is-invalid @enderror"
                                                name="firstname" id="firstname" value="{{ old('firstname') }}"
                                                pattern="[a-z A-Z ]{4,}" title="enter only letters" required>
                                            @error('firstname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="lastname">الاسم الأخير<span class="required">*</span></label>
                                            <input type="text"
                                                class="form-control @error('lastname') is-invalid @enderror" name="lastname"
                                                id="lastname" value="{{ old('lastname') }}" pattern="[a-z A-Z ]{4,}"
                                                title="enter only letters" required>
                                            @error('lastname')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">الهاتف<span class="required">*</span></label>
                                            <input type="number" class="form-control @error('phone') is-invalid @enderror"
                                                name="phone" id="phone" value="{{ old('phone') }}" pattern="{8,10}"
                                                title="enter only letters" required>
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email">الايميل<span class="required">*</span></label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>



                                        <div class="form-group">
                                            <label for="photo">الصورة<span class="required">*</span></label>
                                            <input type="file" class="form-control-file @error('photo') is-invalid @enderror"
                                                name="photo" id="photo"  pattern="{8,10}" accept="image/*" required>
                                                
                                            @error('photo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password">كلمة السر<span class="required">*</span></label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password-confirm"
                                                class="col-md-4 col-form-label text-md-end">تأكيد كلمة السر<span class="required">*</span></label>


                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">

                                        </div>


                                        <button type="submit" style="float: right;" class="btn btn-primary">حفظ</button>
                                        <p>
                                            <span class="required">*</span>حقل مطلوب
                                        </p>
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
    </script>
@endpush
