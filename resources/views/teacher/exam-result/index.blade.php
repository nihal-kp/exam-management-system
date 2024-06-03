@extends("teacher.layouts.app")
@section('title', 'Exam Results')
@section("content")

    <!-- Begin Page Content -->
    <div class="container-fluid">
        @if(session()->has('success message'))
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session()->get('success message') }}
            </div>
        @elseif(session()->has('failed message'))
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session()->get('failed message') }}
            </div>
        @endif
        <div class="row">
            <!-- Page Heading -->
            <div class="col-6">
            <h1 class="h3 mb-2 text-gray-800">Exam Results</h1>
            </div>
        </div>
        <!--<p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.-->
        <!--    For more information about DataTables, please visit the <a target="_blank"-->
        <!--        href="https://datatables.net">official DataTables documentation</a>.</p>-->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <!--<div class="card-header py-3">-->
            <!--    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>-->
            <!--</div>-->
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>SI No.</th>
                                <th>Student</th>
                                <th>Exam</th>
                                <th>Mark</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($exam_results as $val)
                            <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$val->student->name}}</td>
                            <td>{{$val->exam->name}}</td>
                            <td>{{$val->mark}}</td>
                            <td>
                                @if($val->passed != '1')
                                    <span class="text-danger">Failed</span>
                                @else
                                    <span class="text-success">Passed</span>
                                @endif 
                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @endsection

   @push('modal')      

    <!-- Delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to delete this data?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="#" onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();">Delete</a>
                    
                    <form id="delete-form" action="" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                                    
                </div>
            </div>
        </div>
    </div>

  <div class="modal fade" id="viewModal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">View Exam Result</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="">
                <table class="table table-borderless">
                    <tr>
                        <th>Name </th><th>:</th><td id="name_view"></td>
                    </tr>
                </table>
               
            </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  
  @endpush

  @push('script')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
    <!--<script src="{{ asset('js/jquery.toast.min.js')}}" type="text/javascript"></script>-->
    <!--<script src="{{ asset('js/toastr.js')}}" type="text/javascript"></script>-->
    <script type="text/javascript">
        
    setTimeout(function() {
    $('.alert-success').fadeOut();
    }, 5000)
    
    setTimeout(function() {
    $('.alert-danger').fadeOut();
    }, 5000)
    
    </script>
  @endpush