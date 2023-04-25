 <script type="text/javascript">
   var token="{{csrf_token()}}";
   var user_id="{{UserDetail(Auth::id())->lock_screen_token}}";
 </script>
<script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>



<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{asset('assets/izitoast/js/iziToast.min.js')}}"></script>





<!-- Required datatable js -->
<script src="{{asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<!-- Buttons examples -->
<script src="{{asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/libs/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- Responsive examples -->
<script src="{{asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

<script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>

<script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>


<script src="{{asset('assets/libs/chart.js/Chart.bundle.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery-ui/jquery-ui.min.js')}}"></script>

<!-- ///////////////////////sortable/////////////////////////////////////////// -->
<script src="{{asset('assets/libs/jquery-ui/ui/Sortable.min.js')}}"></script>
<script src="{{asset('assets/libs/jquery-ui/ui/jquery-sortable.js')}}"></script>

<script src="{{asset('assets/js/functions.js')}}"></script>

<!-- ///////////////////////sortable////////////////////////////////////////////// -->
<script src="{{asset('assets/context-menu/jquery.contextMenu.js')}}" type="text/javascript"></script>

<script src="{{asset('assets/context-menu/jquery.ui.position.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/selectpicker/js/bootstrap-select.js')}}"></script>


        <!--tinymce js-->
<script src="{{asset('assets/libs/tinymce/tinymce.min.js')}}"></script>

        <!-- init js -->
<script src="{{asset('assets/js/pages/form-editor.init.js')}}"></script>





<script type="text/javascript">

  $(document).ready(function(){
    InitEditor();

  setInterval(function() {
      $.ajax({
          url:"{{url('admin/check-auth')}}",
          success:function(res){
            console.log(res);
            if(!res){
              window.location="{{url('admin/lock-screen')}}?id="+user_id;
            }
          },
          error:function() {
            location.reload();
          }
      })

  }, 101000);



  $(".select2").select2({
    width:"100%"
  });

$(function () {
  $('[data-toggle="popover"]').popover()
});



  $(document).on('click', '.img', function(){

    var img_src=$(this).attr('src');
    var src_html='<img src="'+img_src+'" width="100%">';
  Swal.fire({
    html:src_html,
    width: '50%'
  });
  });

$(document).on('click', '#maintenance',function (e) {

      if($(this).is(':checked')){
            Swal.fire({
              title: 'Are you sure you want to up the Application',
              showDenyButton: true,
              confirmButtonText: 'Yes',
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href="{{url('admin/artisan/up')}}";
                $(this).prop("checked", true);
              }else{
                $(this).prop("checked", false);
              }
          });

      }
      else {
            Swal.fire({
              title: 'Are you sure you want to down the Application',
              showDenyButton: true,
              confirmButtonText: 'Yes',
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href="{{url('admin/artisan/down')}}";
                $(this).prop("checked", false);
              }else{
                $(this).prop("checked", true);
              }
          });

      }
  
});


        $.contextMenu({
            selector: 'body',
            autoHide: true,
            zIndex: 11111,
            callback: function(key, opt){ 
                url_link=opt.commands[key].url_link;
                window.location.href=url_link;
            },
            items: {
                dashboard: {name: "Dashboard", url_link:'{{url("admin/home")}}', icon: 'fas fa-home',},
                refresh: {name: "Refresh", url_link:'{{url()->current()}}', icon: 'fas fa-redo',},
                "sep1": "---------",

                @can('users.view')
                users: {name: "Users", url_link:'{{url("admin/users")}}', icon: 'fas fa-users',},
                @endcan

                @can('roles.view')
                roles: {name: "Roles", url_link:'{{url("admin/roles")}}', icon: 'fas fa-user-lock',},
                "sep2": "---------",
                @endcan


                @can('table-bookings.view')
                table_bookings: {name: "Table Bookings", url_link:'{{url("admin/table-bookings")}}', icon: 'fas fa-coffee',},
                "sep3": "---------",
                @endcan

                @can('sittings.view')
                sittings: {name: "Sittings", url_link:'{{url("admin/sittings")}}', icon: 'fas fa-chair',},
                @endcan

                @can('sitting-structure.view')
                sitting_structure: {name: "Sitting Structure", url_link:'{{url("admin/sitting-structure")}}', icon: 'fas fa-th-large',},
                "sep5": "---------",
                @endcan


                @can('menu.view')
                menu: {name: "CMS Menu", url_link:'{{url("admin/menu")}}', icon: 'fas fa-laptop-code',},
                @endcan
                @can('pages.view')
                pages: {name: "CMS Pages", url_link:'{{url("admin/pages")}}', icon: 'fas fa-laptop-code',},
                "sep6": "---------",
                @endcan


                @can('settings.view')
                settings: {name: "Settings", url_link:'{{url("admin/settings")}}', icon: 'fas fa-cog',}
                @endcan
            }
        }); 
 



});
</script>