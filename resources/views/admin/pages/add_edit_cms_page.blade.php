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
                        <h3 class="card-title">{{ $title }}</h3>

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
                                <form name="cmsForm" id="cmsForm" @if(empty($cmspage['id'])) action="{{ url('admin/add-edit-cms-page')}}" @else action="{{ url('admin/add-edit-cms-page/'.$cmspage['id'])}}" @endif
                                    method="POST">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title">Title*</label>
                                            <input type="text" class="form-control" id="title"
                                                placeholder="Enter Page Title" name="title" @if(!empty($cmspage['title'])) value="{{$cmspage['title']}}" @endif >
                                        </div>
                                        <div class="form-group">
                                            <label for="url">URL*</label>
                                            <input type="text" class="form-control" id="url"
                                                placeholder="Enter Page URL" name="url" @if(!empty($cmspage['url'])) value="{{$cmspage['url']}}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description*</label>
                                            <textarea class="form-control" id="description" rows="3" placeholder="Enter Page Description" name="description" >@if(!empty($cmspage['description'])) {{$cmspage['description']}} @endif</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_title">Meta Title*</label>
                                            <input type="text" class="form-control" id="meta_tile"
                                                placeholder="Enter Meta Title" name="meta_title" @if(!empty($cmspage['meta_title'])) value="{{$cmspage['meta_title']}}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description*</label>
                                            <input type="text" class="form-control" id="meta_description"
                                                placeholder="Enter Meta Description" name="meta_description" @if(!empty($cmspage['meta_description'])) value="{{$cmspage['meta_description']}}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_keywords">Meta Keywords*</label>
                                            <input type="text" class="form-control" id="meta_keywords"
                                                placeholder="Enter Meta Keywords" name="meta_keywords"  @if(!empty($cmspage['meta_keywords'])) value="{{$cmspage['meta_keywords']}}" @endif>
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
