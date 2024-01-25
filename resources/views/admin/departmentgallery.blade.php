@extends('admin.layout.layout')

@section('content');


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">DEPARTMENT GALLERY ( {{ ucwords($deptcategoryone['deptcategories_name']) }} )</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">DEPARTMENT GALLERY</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-4">
            <div class="card card-primary">
                <div class="card-header">
                    @if(empty($departmentgalleriesone['departmentgalleries_id']))
                     <h3 class="card-title">Add Department Picture</h3>
                    @else
                     <h3 class="card-title">Edit Department Picture</h3>
                    @endif
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                        
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(Session::has('error_message'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error: </strong> {{ Session::get('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                            
                @if(Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success: </strong> {{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                
                @if(empty($departmentone['departments_id']))
                <form method="post" action="{{ url('admin/departmentgallery/' . $departmentone['departments_id']) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="departments_id">Departments ID</label>
                        <input type="hidden"  class="form-control" id="departmentsid" value="{{ $departmentone['departments_id'] }}" readonly name="departmentsid">
                    </div>       

                    <div class="form-group">
                        <label for="departments_file">Image</label>
                        <input type="file" class="form-control"  name="departmentgalleries_file" id="departmentgalleries_file" placeholder="Department Gallery Image" required>
                    </div>           
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
                @else
                <form method="post" 
                action="{{ url('admin/departmentgallery/'. $departmentone['departments_id'] . '/' . $departmentgalleriesone->departmentgalleries_id ) }}" enctype="multipart/form-data">@csrf
                    <div class="card-body">
                    <div class="form-group" style="display:none;">
                        <label for="admin_id">Admin ID</label>
                        <input type="hidden"  class="form-control" id="admin_id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                    </div>
                    <div class="form-group" style="display:none;">
                        <label for="departmentsid">Department ID</label>
                        <input type="text" class="form-control"  name="departments_id" id="departments_id" value="{{ $departmentgalleriesone['departmentsid'] }}" required>
                    </div> 
                    <div class="form-group" style="display:none;">
                        <label for="departmentgalleries_id">Department Gallery ID</label>
                        <input type="text" class="form-control"  name="departmentgalleries_id" id="departmentgalleries_id" value="{{ $departmentgalleriesone['departmentgalleries_id'] }}" required>
                    </div> 
                    <div class="form-group">
                        <label for="departmentgalleries_file">Image (Optional)</label>
                        <input type="file" class="form-control"  name="departmentgalleries_file" id="departmentgalleries_file" placeholder="Department Image">
                    </div> 
                    <div class="form-group" style="display:none;">
                        <label for="currentdepartmentgalleries_file">Current Image</label>
                        <input type="text" class="form-control"  name="currentdepartmentgalleries_file" id="currentdepartmentgalleries_file" placeholder="Department Gallery Image" value="{{ $departmentgalleriesone['departmentgalleries_file'] }}">
                    </div>           
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block">Edit</button>
                    </div>
                </form>
                @endif
                </div>
            </div>
          <div class="col-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DEPARTMENT GALLERY ( {{ ucwords($deptcategoryone['deptcategories_name']) }} )</h3>
                @if(!empty($departmentgalleriesone['departmentgalleries_id']))
                <a href="{{ url('admin/departmentgallery/' . $departmentone['departments_id']) }}" class="btn btn-primary" 
                  style="float:right;">
                   Add Department Pictures
                </a>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive" style="overflow-y:scroll">
                <table id="tablepages" class="table table-bordered table-striped" >
                  
                <thead>
                  <tr> 
                    <th>Image</th>
                    <th>Actions </th>
                  </tr>
                <thead>
                  
                  <tbody> 
                    @foreach($departmentgalleries as $departmentgallery)           
                  <tr>
                    <td>
                       <div id="div_img">
                         <img src="{{ asset('admin/img/departmentgalleries/'.$departmentgallery->departmentgalleries_file) }}" class="img-circle elevation-2" alt="Department Image">
                       </div>
                    </td>
                    <td>                     
                      <a href="{{  url('admin/departmentgallery/' . $departmentgallery->departmentsid . '/'.$departmentgallery->departmentgalleries_id) }}" style="color:#3f6ed3;">
                        <i class="fas fa-edit"></i>
                      </a>
                      &nbsp;&nbsp;
                      <a href= "javascript:void(0)" record="departmentgallery" 
                      recordid="{{ $departmentgallery->departmentsid . '/' . $departmentgallery->departmentgalleries_id }}" <?php //"{{  url('admin/delete-cms-page/'.$page['id']) }}" ?> style="color:#ee4b2b;" class="confirmDelete" name="Department Picture" title="Delete Department Picture">
                        <i class="fas fa-trash"></i>
                      </a> 
                    </td>
                    </tr>   
                     @endforeach
                             
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->

@endsection
