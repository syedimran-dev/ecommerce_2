@extends('admin.layout.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- SELECT2 EXAMPLE -->


                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-name">{{ $title }}</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (Session::has('error_message'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong> {{ Session::get('error_message') }}.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form name="subAdminForm" id="subAdminForm"
                                    @if (empty($subadmin['id'])) action="{{ url('admin/add-edit-subadmin') }}" @else action="{{ url('admin/add-edit-subadmin/' . $subadmin['id']) }}" @endif
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Name*</label>
                                            <input type="text" class="form-control" id="name"
                                                placeholder="Enter Sub Admin Name" name="name"
                                                @if (!empty($subadmin['name'])) value="{{ $subadmin['name'] }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile">Mobile*</label>
                                            <input type="text" class="form-control" id="mobile"
                                                placeholder="Enter Page mobile" name="mobile"
                                                @if (!empty($subadmin['mobile'])) value="{{ $subadmin['mobile'] }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email*</label>
                                            <input @if ($subadmin['email'] != '') disabled style="background-color: #666" @else required @endif
                                                type="text" class="form-control" id="email"
                                                placeholder="Enter Sub Admin Email" name="email"
                                                @if (!empty($subadmin['email'])) value="{{ $subadmin['email'] }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password*</label>
                                            <input type="password" class="form-control" id="password"
                                                placeholder="Enter Password" name="password"
                                                @if (!empty($subadmin['password'])) value="{{ $subadmin['password'] }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="image">Photo</label>
                                            <input name="image" type="file" class="form-control" id="image"
                                                placeholder="Image">
                                            @if (!empty(!empty($subadmin['image'])))
                                                <a target="_blank" href="/storage/{{ $subadmin['image'] }}"
                                                    class="btn btn-primary mt-3">View Image</a>
                                                <input type="hidden" name="current_image"
                                                    value="{{ $subadmin['image'] }}">
                                            @endif
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                    </div>
                </div>
                <!-- /.card -->



            </div> <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
