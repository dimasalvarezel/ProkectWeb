@extends('admin.layouts.app')

@section('title', 'Tambah Artikel')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Articles</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><small><strong>Content</strong></small></li>
            <li class="breadcrumb-item"><small><strong>Articles</strong></small></li>
            <li class="breadcrumb-item text-green"><small><strong>Add</strong></small></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- jquery validation -->
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title"><strong>Tambahkan Data Artikel</strong></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{route('admin.article.add')}}" id="quickForm" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="title">Judul Artikel</label>
                      <input type="text" name="title" class="form-control" id="title" placeholder="Masukkan Judul Artikel">
                    </div>
                    <div class="form-group">
                      <label for="kategori_id">Kategori</label>
                      <select class="form-control select2bs4" name="category_id" style="width: 100%;">
                        @foreach($category as $list)
                        <option value="{{$list->id}}">{{$list->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="tag_id">Tag</label>
                      <div class="select2-green">
                        <select name="tags[]" class="form-control select2" multiple="multiple" data-placeholder="Pilih Tag" data-dropdown-css-class="select2-green" style="width: 100%;">
                          @foreach($tag as $list)
                          <option value="{{$list->id}}">{{$list->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="img">Gambar</label>
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" name="img" id="img">
                          <label class="custom-file-label" for="img">Unggah Gambar</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="status">Terbitkan</label>
                      <div class="select2-green">
                        <select class="form-control select2bs4" name="status" style="width: 100%;">
                          <option value="show">Ya</option>
                          <option value="hide">Tidak</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="short_description">Selayang Pandang (Ringkasan)</label>
                      <input type="text" name="short_description" class="form-control" id="short_description" placeholder="Masukkan Selayang Pandang Artikel">
                    </div>
                    <div class="form-group">
                      <label for="content">Konten</label>
                      <textarea name="content" id="content" class="textarea"></textarea>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" id="submit" class="btn btn-success float-right"><i class="fas fa-plus-square"></i>&nbsp;&nbsp;Tambah</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
              </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
</div>
@endsection

@section('top-resource')
<!-- summernote -->
<link rel="stylesheet" href="{{asset('backend/plugins/summernote/summernote-lite.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('backend/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection

@section('bottom-resource')
<!-- jquery-validation -->
<script src="{{asset('backend/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-validation/additional-methods.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () {
  $('#quickForm').validate({
    ignore: ".textarea *",
    rules: {
      title: {
        required: true,
      },
      category_id: {
        required: true,
      },
      status: {
        required: true,
      },
      short_description: {
        required: true,
      },
      content: {
        required: true,
      }
    },
    messages: {
      title: {
        required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan judul artikel",
      },
      category_id: {
        required: "&nbsp;"+"Kolom tidak boleh kosong, pilih kategori artikel",
      },
      status: {
        required: "&nbsp;"+"Kolom tidak boleh kosong, pilih status penerbitan",
      },
      short_description: {
        required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan selayang pandang (ringkasan) artikel",
      },
      content: {
        required: "&nbsp;"+"Kolom tidak boleh kosong, masukkan konten artikel",
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    },
    submitHandler: function (form) {
       $('#submit').attr('disabled','disabled');
       form.submit();
    }
  });
});
</script>
<!-- Summernote -->
<script src="{{asset('backend/plugins/summernote/summernote-lite.min.js')}}"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote({
      height: 250
    });
  })
</script>
<!-- Select2 -->
<script src="{{asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('backend/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('backend/plugins/inputmask/min/jquery.inputmask.bundle.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('backend/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{asset('backend/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- Page script -->
<script>
    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>

@endsection
