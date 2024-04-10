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
                                    <button type="button" onclick="location.href=`{{ route('admin.users.add') }}`"
                                        class="btn btn-primary " style="    float: right;">
                                        مستخدم جديد <i class="fa fa-plus "></i></button>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="users-datatable"
                                        class="table users-datatable  table-bordered order-column stripe hover w-100">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>الصورة</th>
                                                <th>الاسم الأول</th>
                                                <th>الاسم الأخير</th>
                                                <th>البريد الالكتروني</th>
                                                <th>تاريخ انشاء الحساب</th>
                                                <th>فعال</th>
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
                    <button onclick="delete_owner()" class="btn bg-danger text-white" data-dismiss="modal">حذف</button>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <!-- university datatable-->
    <script type="text/javascript">
        var id;
        $(document).ready(function() {
            $(function() {

                users_table = $('#users-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    scrollX: true,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ar.json',
                    },
                    lengthMenu: [10, 50, 100, 150],
                    columnDefs: [{
                        className: "td_center",
                        targets: "_all"
                    }, ],
                    ajax: "{{ route('admin.users.get') }}",
                    columns: [{
                            data: 'ownerId',
                            name: 'ownerId'
                        },
                        {
                            data: 'photo',
                            name: 'photo',

                        },
                        {
                            data: 'firstname',
                            name: 'firstname',

                        },
                        {
                            data: 'lastname',
                            name: 'lastname',

                        },
                        {
                            data: 'email',
                            name: 'email',

                        },

                        {
                            data: 'registerationdate',
                            name: 'registerationdate',

                        },
                        {

                            data: 'isactive',
                            name: 'isactive',
                            render: function(data, type, row) {
                                if (row.isactive == 1)
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
        });

        function opendel_owner($id) {
            id = $id;

        }
        //delete function
        function delete_owner() {
            //  alert(id);

            $.ajax({
                type: 'post',
                url: "{{ route('admin.users.delete') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': id,

                },
                success: function(data) {
                    //console.log(data);
                    if (data == 'empty') {
                        users_table.ajax.reload();
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
                    toastMixin.fire({
                        icon: 'error',
                        animation: true,
                        title: 'حدثت مشكلة'
                    });
                }

            });


        }

        function toggle_active(id) {
            //alert(id);
            $.ajax({
                type: 'post',
                url: "{{ route('admin.users.active') }}",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'id': id,

                },
                success: function(data) {
                    //console.log(data);
                    if (data == 'empty') {
                        users_table.ajax.reload();
                        toastMixin.fire({
                            animation: true,
                            title: 'تم تغيير حالة التفعيل بنجاح'
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
                    toastMixin.fire({
                            icon: 'error',
                            animation: true,
                            title: 'حدثت مشكلة'
                        });
                }

            });
        }
    </script>
@endpush
