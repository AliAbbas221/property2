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
                                    <form action="{{ route('admin.admins.update') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        
                                        <div class="form-group">
                                            <label for="name">الاسم الأول</label>
                                            <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                                name="name" id="name" value="{{ old('name', $user->name) }}"
                                                pattern="[a-z A-Z ]{4,}" title="enter only letters">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        <div class="form-group">
                                            <label for="email">البريد الالكتروني</label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email', $user->email) }}" autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>


                                        {{-- <div class="form-group">
                                            <label for="password">كلمة السر</label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">تأكيد
                                                كلمة السر</label>


                                            <input id="password-confirm" type="password" class="form-control"
                                                name="password_confirmation" autocomplete="new-password">

                                        </div> --}}


                                        <button type="submit" style="float: right;" class="btn btn-primary">حفظ</button>

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

        //for update  photo 
        {
            function triggerClick_owner(e) {
                document.querySelector('#photo').click();
            }

            function displayImage_owner(e) {
                if (e.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.querySelector('#o_display').setAttribute('src', e.target.result);
                    }
                    reader.readAsDataURL(e.files[0]);
                }
            }
        }
    </script>
@endpush
