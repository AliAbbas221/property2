<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                @yield('title',(request()->segment(count(request()->segments())) == ''?"Home":Str::headline(request()->segment(count(request()->segments())))) )
                </h1>
                
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"> <a href="/">Home</a> </li>
                    <?php $link = ''; ?>
                    @for ($i = 1; $i <= count(Request::segments()); $i++)
                        @if (($i <= count(Request::segments())) & ($i > 0))
                            @if (is_numeric(Request::segment($i)))
                                <?php $link .= '/' . Request::segment($i); ?>
                            @else
                                <?php $link .= '/' . Request::segment($i); ?>
                                <li class="breadcrumb-item active"><a
                                        href="<?= $link ?>">{{ Str::headline(ucwords(str_replace('-', ' ', Request::segment($i)))) }}</a>
                                </li>
                            @endif
                        @else
                            {{ Str::headline(ucwords(str_replace('-', ' ', Request::segment($i)))) }}
                        @endif
                    @endfor

                </ol>

            </div>

        </div>
    </div><!-- /.container-fluid -->
</section>
