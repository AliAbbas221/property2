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
                                    <h3 class="card-title " style="float: right;"> اخر أخبار العقارات</h3>
                                    <div class="card-tools" style="float: left">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                                class="fas fa-minus"></i>
                                        </button>
                                        {{-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                                class="fas fa-times"></i></button> --}}
                                    </div>

                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>عنوان المنشور</th>
                                                <th>السعر</th>
                                                <th>تاريخ النشر</th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($propertys as $property)
                                                <tr>
                                                    <td style=" /*white-space: pre-line*/;">
                                                        {{ $property->title }}
                                                    </td>
                                                    <td style=" /*white-space: pre-line*/;">
                                                        {{ $property->price }}
                                                    </td>
                                                    <td>{{ $property->publishDate }}</td>

                                                </tr>
                                            @endforeach

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
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="float: right">اخر أخبار السيارات</h3>
                            <div class="card-tools" style="float: left">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                                {{-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-times"></i></button> --}}
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>

                                        <th>عنوان المنشور</th>

                                        <th>سنة التصنيع</th>
                                        <th>السعر</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cars as $car)
                                        <tr>

                                            <td>
                                                {{ $car->cartitle }}</td>
                                            <td>
                                                {{ $car->manufactureyear }}
                                            </td>

                                            <td>{{ $car->price }}</td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                    </div>

                </div>

                <!-- /.col -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title" style="float: right">اخر أخبار الأغراض المستعملة</h3>
                            <div class="card-tools" style="float: left">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                                {{-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-times"></i></button> --}}
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>عنوان المنشور</th>
                                        <th>نوع الغرض</th>
                                        <th>السعر</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td> {{ $item->title }}</td>
                                            <td>{{ $item->type->usedtypename }}</td>
                                            <td>
                                                {{ $item->price }}
                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                    </div>

                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title" style="float: right">أعداد المنشورات</h3>

                            <div class="card-tools" style="float: left">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                                {{-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-times"></i></button> --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="pieChart"
                                style="height: 230px; min-height: 230px; display: block; width: 304px;"
                                width="304" height="230" class="chartjs-render-monitor"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div></div>
            </div>




        </div><!-- /.container-fluid -->
    </section>
@endsection

@push('scripts')
    <script>
        $(function() {

            var donutData = {
                labels: [
                    'عقارات',
                    'سيارات',
                    'أغراض مستعملة',

                ],
                datasets: [{
                    data: [{{ $p }}, {{ $c }}, {{ $i }}],
                    backgroundColor: ['#00a65a', '#f39c12', '#00c0ef'],
                }]
            }


            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = donutData;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })
        })
    </script>
@endpush
