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
                                    <button type="button" href="#addModal" data-toggle="modal" class="btn btn-primary "
                                        style="    float: right;">
                                        مُصنع جديد <i class="fa fa-plus "></i></button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="manufacture-datatable"
                                        class="table manufacture-datatable  table-bordered order-column stripe hover w-100">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>الصورة</th>
                                                <th>الاسم</th>
                                                <th>الموقع</th>

                                                <th>تحكم</th>
                                            </tr>
                                        </thead>
                                        <tbody>



                                        </tbody>
                                    </table>
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
    <!-- add Modal -->
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true" style="    opacity: 100%;">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header ">

                    <h2 class="modal-title" id="addModalLabel">إضافة مُصنع جديد</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                        style="margin: -1rem auto -1rem -1rem;">&times;</button>
                </div>
                <form id="addform_man" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">الاسم</label>
                            <input id="name" type="text" name="name" class="form-control" required>

                        </div>
                        <div class="form-group">
                            <label for="companylogo">الصورة</label><br>
                            <input type="file" name="companylogo" id="companylogo" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="url">رابط الموقع</label><br>
                            <input type="url" name="url" id="url" class="form-control">
                        </div>



                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn bg-secondary text-white" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary text-white">إضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- edit Modal -->
    <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true" style="    opacity: 100%;">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header ">

                    <h4>تعديل المعلومات</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                        style="    margin: -1rem auto -1rem -1rem;">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="editform_man" method="post">
                        @csrf
                        <input type="hidden" name="id_edit" id="id_edit" />
                        <div class="form-group">
                            <label for="name_edit">الاسم</label>
                            <input id="name_edit" type="text"
                                class="form-control @error('name_edit') is-invalid @enderror" name="name_edit"
                                value="" required autocomplete="name_edit">

                            @error('name_edit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror


                        </div>

                        <div class="form-group">
                            <label for="img_edit">الأيقونة</label>
                            <br>


                            <input type="file" name="photo" class="form-control" id="photo"
                                onChange="displayImage_man(this)" style="display: none;">
                            <img src="" onClick="triggerClick_man()" id="u_display" height='200'
                                width='250'style=" cursor: pointer;" />

                            @error('img_edit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror


                        </div>
                        <div class="form-group">
                            <label for="icon">رابط الموقع</label><br>
                            <input type="url" name="url_edit" id="url_edit" class="form-control">
                        </div>


                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn bg-secondary text-white" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn bg-primary text-white">تعديل</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- del Modal -->
    <div id="delModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true" style="    opacity: 100%;">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header ">


                    <h4>هل أنت متأكد ؟</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>هل حقا تريد حذف السجل، هذه العملية غير قابلة للعكس</p>
                </div>
                <div class="modal-footer justify-content-center">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button onclick="delete_man()" class="btn bg-danger text-white" data-dismiss="modal">حذف</button>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- manufacture datatable-->
    <script type="text/javascript">
        var id;
        var manufacture_table;
        var toastMixin = Swal.mixin({
            toast: true,
            icon: 'success',
            title: 'General Title',
            animation: false,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        $(document).ready(function() {
            $(function() {

                manufacture_table = $('#manufacture-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    lengthMenu: [10, 50, 100, 150],
                    scrollX: true,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json',
                    },
                    columnDefs: [{
                        className: "td_center",
                        targets: "_all"
                    }, ],
                    ajax: "{{ route('admin.cars.manufacture.get') }}",
                    columns: [{
                            data: 'carmanufactureid',
                            name: 'carmanufactureid'
                        },
                        {
                            data: 'companylogo',
                            name: 'companylogo',

                        },
                        {
                            data: 'companyname',
                            name: 'companyname',

                        },
                        {
                            data: 'companysite',
                            name: 'companysite',

                        },

                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });

            });


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $("#addform_man").submit(function(event) {
                event.preventDefault();
                var formData = new FormData($('#addform_man')[0]);

                $.ajax({
                    type: 'post',
                    url: "{{ route('admin.cars.manufacture.create') }}",
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: formData,
                    success: function(data) {
                        manufacture_table.ajax.reload();
                        toastMixin.fire({
                            animation: true,
                            title: 'تم إضافة مُصنع جديد بنجاح'
                        });
                    },
                    error: function(rejest) {}

                });
                $('#addModal .close').click();
                $('.modal-backdrop').hide();
                $(this)
                    .find("input,textarea,select")
                    .val('')
                    .end();


            })


            $("#editform_man").submit(function(event) {
                event.preventDefault();
                var formData = new FormData($('#editform_man')[0]);


                $.ajax({
                    type: 'post',
                    url: "{{ route('admin.cars.manufacture.update') }}",
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: formData,
                    success: function(data) {
                        manufacture_table.ajax.reload();
                    },
                    error: function(rejest) {}

                });
                $('#editModal .close').click();
                //$('#editModal').modal('toggle');
                $('.modal-backdrop').hide();
                $(this)
                    .find("input,textarea,select")
                    .val('')
                    .end();

                toastMixin.fire({
                    animation: true,
                    title: 'تم التعديل بنجاح '
                });
            })
            $('.modal').on('hidden.bs.modal', function() {

                $('form').find(
                    'input[type=text], input[type=password], input[type=number], input[type=email],input[type=file], textarea'
                ).val('');

            });
        })



        //get values from db and show in edit modal
        function getDetails_man($id) {
            var getURL = '{{ route('admin.cars.manufacture.getById', ['id' => 'man_id']) }}';
            getURL = getURL.replace("man_id", $id);

            $.ajax({
                type: 'GET',
                url: getURL,

                success: function(data) {

                        $('#id_edit').val(data.carmanufactureid);
                        $('#name_edit').val(data.companyname);
                        var src = data.companylogo;
                        $('#u_display').attr("src", src);
                        $('#url_edit').val(data.companysite);


                    }

                    ,
                error: function(rejest) {}

            });
        }


        function opendel_man($id) {
            id = $id;

        }
        //delete function
        function delete_man() {
            //  alert(id);

            $.ajax({
                type: 'post',
                url: "{{ route('admin.cars.manufacture.delete') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': id,

                },
                success: function(data) {
                    //console.log(data);
                    if (data == 'empty') {
                        manufacture_table.ajax.reload();
                        toastMixin.fire({
                            animation: true,
                            title: 'تم الحذف بنجاح'
                        });
                    }
                    if (data == 'error') {
                        toastMixin.fire({
                            icon: 'error',
                            animation: true,
                            title: 'حدثت مشكلة'
                        });
                    }


                },
                error: function(rejest) {
                    alert('fail');
                }

            });


        }

        //for update clinic photo in edit modal
        {
            function triggerClick_man(e) {
                document.querySelector('#photo').click();
            }

            function displayImage_man(e) {
                if (e.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.querySelector('#u_display').setAttribute('src', e.target.result);
                    }
                    reader.readAsDataURL(e.files[0]);
                }
            }
        }
    </script>
@endpush
