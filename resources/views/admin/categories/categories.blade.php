@extends('admin.layout.layout')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Categories</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Categories</h3>
                                @if ($categoriesModule['edit_access'] == 1 || $categoriesModule['full_access'] == 1)
                                    <a href="{{ url('admin/add-edit-category') }}"
                                        style="max-width: 150px; float: right; display:inline-block"
                                        class="btn btn-primary">Add
                                        Category</a>
                                @endif
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="cmspages" class="table table-bordered table-striped">
                                    @if (Session::has('success_message'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Success!</strong> {{ Session::get('success_message') }}.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Parent ID</th>
                                            <th>URL</th>
                                            <th>Created On</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category['id'] }}</td>
                                                <td>{{ $category['category_name'] }}</td>
                                                <td>
                                                    @if (isset($category['parentcategory']['category_name']))
                                                        {{ $category['parentcategory']['category_name'] }}
                                                    @endif
                                                </td>
                                                <td>{{ $category['url'] }}</td>
                                                <td>{{ date('F j, Y, g:i a', strtotime($category['created_at'])) }}</td>
                                                <td>
                                                    @if ($categoriesModule['edit_access'] == 1 || $categoriesModule['full_access'] == 1)
                                                        @if ($category['status'] == 1)
                                                            <a class="updateCategoryStatus"
                                                                id="category-{{ $category['id'] }}"
                                                                category_id="{{ $category['id'] }}"
                                                                href="javascript:void(0)"><i class="fas fa-toggle-on"
                                                                    status="Active"></i></a>
                                                        @else
                                                            <a class="updateCategoryStatus" style="color: gray"
                                                                id="category-{{ $category['id'] }}"
                                                                category_id="{{ $category['id'] }}"
                                                                href="javascript:void(0)"><i class="fas fa-toggle-off"
                                                                    status="Inactive"></i></a>
                                                        @endif
                                                    @endif
                                                    @if ($categoriesModule['edit_access'] == 1 || $categoriesModule['full_access'] == 1)
                                                        &nbsp;&nbsp;
                                                        <a href="{{ url('admin/add-edit-category/' . $category['id']) }}"><i
                                                                class="fas fa-edit"></i></a>
                                                    @endif
                                                    @if ($categoriesModule['full_access'] == 1)
                                                        &nbsp;&nbsp;
                                                        <a href="{{ url('admin/delete-category/' . $category['id']) }}"><i
                                                                class="fas fa-trash"></i></a>
                                                    @endif
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
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
