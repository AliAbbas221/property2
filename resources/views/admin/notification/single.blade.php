@extends('layouts.admin.main')


@section('content')
    <style>
        .select2-container--open {
            /* right: 0 !important; */
            /* left: auto !important; */
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
                                    <button type="button" href="#addModal" data-toggle="modal" class="btn btn-primary "
                                        style="    float: right;">
                                        إشعار مخصص جديد <i class="fa fa-plus "></i></button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="type-datatable"
                                        class="table type-datatable  table-bordered order-column stripe hover w-100">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>المرسل إليه</th>
                                                <th> العنوان</th>

                                                <th>المحتوى</th>
                                                <th>نوع الإشعار</th>
                                                <th>تاريخ الإرسال</th>

                                                <th>تاريخ الفراءة</th>
                                                <th>تمت قرائته</th>


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

                    <h2 class="modal-title" id="addModalLabel">إضافة إشعار مخصص جديد</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"
                        style="margin: -1rem auto -1rem -1rem;">&times;</button>
                </div>
                <form id="addform_man" method="post">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="owner">المرسل إليه</label>
                            <select id="owner" name="owner" class="form-control " required>
                                <option value="" hidden></option>
                                @foreach ($owners as $owner)
                                    <option value="{{ $owner->ownerId }}">{{ $owner->firstname . ' ' . $owner->lastname }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="title">العنوان</label>
                            <input id="title" type="text" name="title" class="form-control" required>

                        </div>
                        <div class="form-group">
                            <label for="body">المحتوى</label>
                            <input id="body" type="text" name="body" class="form-control" required>


                        </div>
                        <div class="form-group">
                            <label for="type">نوع الإشعار</label>
                            <input id="type" type="text" name="type" class="form-control" required>

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
                            <label for="owner_edit">المرسل إليه</label>
                            <select id="owner_edit" name="owner_edit" class="form-control " required>

                                @foreach ($owners as $owner)
                                    <option value="{{ $owner->ownerId }}">{{ $owner->firstname . ' ' . $owner->lastname }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="title_edit">العنوان</label>
                            <input id="title_edit" type="text" name="title_edit" class="form-control" required>

                        </div>
                        <div class="form-group">
                            <label for="body_edit">المحتوى</label>
                            <input id="body_edit" type="text" name="body_edit" class="form-control" required>


                        </div>
                        <div class="form-group">
                            <label for="type_edit">نوع الإشعار</label>
                            <input id="type_edit" type="text" name="type_edit" class="form-control" required>

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
                    <button onclick="delete_type()" class="btn bg-danger text-white" data-dismiss="modal">حذف</button>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- type datatable-->
    <script type="text/javascript">
        var id;
        var type_table;
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

            $('#owner').select2({

                dropdownParent: $('#addModal .modal-body')
            });

            $('#owner_edit').select2({

                dropdownParent: $('#editModal .modal-body')
            });
            $(function() {

                type_table = $('#type-datatable').DataTable({
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
                    ajax: "{{ route('admin.notification.single.get') }}",
                    columns: [{
                            data: 'notificationsid',
                            name: 'notificationsid'
                        },
                        {
                            data: 'owner.ownerId',
                            name: 'owner.ownerId',
                            render: function(data, type, row) {
                                $url = "{{ route('admin.users.view', ['id' => 'uid']) }}";
                                $url = $url.replace('uid', row.owner.ownerId);
                                // return ` <a href="users/`+row.owner.ownerId+`/view">`+row.owner.firstname+` `+row.owner.lastname+`</a>`;
                                return ` <a href="` + $url + `" class="">` +
                                    row.owner.firstname + ` ` + row.owner.lastname + `</a>`;

                            }
                        },
                        {
                            data: 'title',
                            name: 'title',

                        },
                        {
                            data: 'body',
                            name: 'body',

                        },
                        {
                            data: 'notificationtype',
                            name: 'notificationtype',
                            render: function(data, type, row) {
                                if (row.notificationtype == null)
                                    return 'غير محدد';
                                else
                                    return row.notificationtype;
                            }

                        },
                        {
                            data: 'senddate',
                            name: 'senddate',

                        },
                        {
                            data: 'readdate',
                            name: 'readdate',
                            render: function(data, type, row) {
                                if (row.readdate == null)
                                    return 'لم تتم قرائته بعد';
                                else
                                    return row.readdate;
                            }

                        },

                        {
                            data: 'is_read',
                            name: 'is_read',
                            render: function(data, type, row) {
                                if (row.is_read == 1)
                                    return 'نعم';
                                else
                                    return 'لا';
                            }

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
                    url: "{{ route('admin.notification.single.create') }}",
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: formData,
                    success: function(data) {
                        type_table.ajax.reload();
                        toastMixin.fire({
                            animation: true,
                            title: 'تم إضافة إشعار مخصص جديد بنجاح'
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
                    url: "{{ route('admin.notification.single.update') }}",
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: formData,
                    success: function(data) {
                        toastMixin.fire({
                            animation: true,
                            title: 'تم التعديل بنجاح '
                        });
                        type_table.ajax.reload();
                    },
                    error: function(rejest) {
                        toastMixin.fire({
                            icon: 'error',
                            animation: true,
                            title: 'حدثت مشكلة'
                        });
                    }

                });
                $('#editModal .close').click();
                //$('#editModal').modal('toggle');
                $('.modal-backdrop').hide();
                $(this)
                    .find("input,textarea,select")
                    .val('')
                    .end();


            })
            $('.modal').on('hidden.bs.modal', function() {

                $('form').find(
                    'input[type=text], input[type=password], input[type=number], input[type=email],input[type=file], textarea'
                ).val('');

            });
        });

        //get values from db and show in edit modal
        function getDetails_type($id) {
            var getURL = '{{ route('admin.notification.single.getById', ['id' => 'man_id']) }}';
            getURL = getURL.replace("man_id", $id);

            $.ajax({
                type: 'GET',
                url: getURL,

                success: function(data) {

                        $('#id_edit').val(data.notificationsid);
                        $('#title_edit').val(data.title);
                        $('#body_edit').val(data.body);
                        $('#type_edit').val(data.notificationtype);
                        $('#owner_edit').val(data.ownerid);




                    }

                    ,
                error: function(rejest) {
                    toastMixin.fire({
                        icon: 'error',
                        animation: true,
                        title: 'حدثت مشكلة'
                    });
                }

            });
        }

        function opendel_type($id) {
            id = $id;

        }
        //delete function
        function delete_type() {
            //  alert(id);

            $.ajax({
                type: 'post',
                url: "{{ route('admin.notification.single.delete') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': id,

                },
                success: function(data) {
                    //console.log(data);
                    if (data == 'empty') {
                        type_table.ajax.reload();
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
    </script>
@endpush
