<!-- jQuery -->
<script src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ URL::asset('dist/js/adminlte.js') }}"></script>

{{-- datarangepicker --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<!-- Ion Slider -->
<script src="{{ URL::asset('plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<!-- Bootstrap slider -->
<script src="{{ URL::asset('plugins/bootstrap-slider/bootstrap-slider.min.js') }}"></script>


<!-- DataTables  & Plugins -->
{{-- <script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script> --}}

{{-- datatabels --}}
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>


{{-- datatabels buttons --}}
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

{{-- pdf make --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>

{{-- notifactions script --}}
{{-- <script>
    function notificationsComponent(numberOfNotifications) {
        return `
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">${numberOfNotifications} Notifications</span>
                <div class="dropdown-divider"></div>
                <div id="list-notifications" ></div>
               
            </div>`;
    }

    function notificationComponent(icon, content, date ,id) {
        return `  <a href="{{ route('site.notifications.index') }}/${id}" class="dropdown-item">
                    <i class="${icon} mr-2"></i> ${content}
                    <span class="float-right text-muted text-sm">${date}</span>
                </a>
                <div class="dropdown-divider"></div>`;
    }

    function messageComponent(name,content,date,id)
    {
        return `<a href="{{ route('site.notifications.index') }}/${id}" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ URL::asset('dist/img/avatar5.png')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                               ${name}
                            </h3>
                            <p class="text-sm">${content}</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> ${date}</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>`;
    }
    
    function addMessage(message){
       
        $('#messages-comp').append(messageComponent(message.data.name,message.data.message,message.date,message.id))
    }
    function addNotification(notification) {
 
        $('#list-notifications').append(notificationComponent(notification.data.icon, notification.data.content,
            notification.date,notification.id))
    }


    $(document).ready(function() {
        $.ajax({
            url: "{{ route('site.notifications.index') }}",
            type: "GET",
            success: function(data) {
                console.log(data)
                $('#notfication-comp').append(notificationsComponent(data.notifications.length))
                if (data.notifications.length) $('#notifications-count').html(data.notifications
                    .length)
                if (data.messages.length){
                    $('#messages-count').html(data.messages
                    .length)
                    data.messages.forEach(addMessage);
                }
                
                data.notifications.forEach(addNotification);

            }
        });

    });
</script> --}}


<!-- sweet alert -->
<script>
    $.fn.select2.defaults.set( "theme", "bootstrap" );

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
</script>
@if (Session::has('status'))
    <script>
        $(document).ready(function() {

            toastMixin.fire({
                animation: true,
                title: "{{ session('status') }}"
            });
        });
    </script>
@endif

@if ($message = Session::get('success'))
    <script>
        $(document).ready(function() {

            toastMixin.fire({
                icon: 'success',
                animation: true,
                title: "{{ $message }}"
            });
        });
    </script>
@endif

@if ($message = Session::get('error'))
    <script>
        $(document).ready(function() {

            toastMixin.fire({
                icon: 'error',
                animation: true,
                title: "{{ $message }}"
            });
        });
    </script>
@endif


@stack('scripts')
