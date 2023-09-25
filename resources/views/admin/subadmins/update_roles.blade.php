@extends('admin.layout.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sub Admins</h1>
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
                                @if (Session::has('success_message'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Success!</strong> {{ Session::get('success_message') }}.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <form name="subAdminForm" id="subAdminForm" action="{{ url('admin/update-role/' . $id) }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="subadmin_id" value="{{ $id }}">
                                    @if (!empty($subadminsRole))
                                        @foreach ($subadminsRole as $role)
                                            @if ($role['module'] == 'cms_pages')
                                                @if ($role['view_access'] == 1)
                                                    @php $viewCmsPages = 'checked' @endphp
                                                @else
                                                    @php $viewCmsPages = "" @endphp
                                                @endif
                                                @if ($role['edit_access'] == 1)
                                                    @php $editCmsPages = 'checked' @endphp
                                                @else
                                                    @php $editCmsPages = "" @endphp
                                                @endif
                                                @if ($role['full_access'] == 1)
                                                    @php $fullCmsPages = 'checked' @endphp
                                                @else
                                                    @php $fullCmsPages = "" @endphp
                                                @endif
                                            @endif
                                            @if ($role['module'] == 'categories')
                                                @if ($role['view_access'] == 1)
                                                    @php $viewCategories = 'checked' @endphp
                                                @else
                                                    @php $viewCategories = "" @endphp
                                                @endif
                                                @if ($role['edit_access'] == 1)
                                                    @php $editCategories = 'checked' @endphp
                                                @else
                                                    @php $editCategories = "" @endphp
                                                @endif
                                                @if ($role['full_access'] == 1)
                                                    @php $fullCategories = 'checked' @endphp
                                                @else
                                                    @php $fullCategroies = "" @endphp
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="cms_pages">CMS Pages*</label>
                                            <input type="checkbox" class="form-control" name="cms_pages[view]"
                                                @if (isset($viewCmsPages)) {{ $viewCmsPages }} @endif value="1">
                                            View Access &nbsp;&nbsp;
                                            <input type="checkbox" class="form-control" name="cms_pages[edit]" @if (isset($editCmsPages)) {{ $editCmsPages }} @endif
                                            value="1">
                                            View/Edit Access &nbsp;&nbsp;
                                            <input type="checkbox" class="form-control" name="cms_pages[full]" @if (isset($fullCmsPages)) {{ $fullCmsPages }} @endif
                                            value="1">
                                            Full Access &nbsp;&nbsp;
                                        </div>
                                        <div class="form-group">
                                            <label for="cms_pages">Categories*</label>
                                            <input type="checkbox" class="form-control" name="categories[view]"
                                                @if (isset($viewCategories)) {{ $viewCategories }} @endif value="1">
                                            View Access &nbsp;&nbsp;
                                            <input type="checkbox" class="form-control" name="categories[edit]" @if (isset($editCategories)) {{ $editCategories }} @endif
                                            value="1">
                                            View/Edit Access &nbsp;&nbsp;
                                            <input type="checkbox" class="form-control" name="categories[full]" @if (isset($fullCategories)) {{ $fullCategories }} @endif
                                            value="1">
                                            Full Access &nbsp;&nbsp;
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
