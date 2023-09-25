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
                                <form name="cmsForm" id="cmsForm"
                                    @if (empty($category['id'])) action="{{ url('admin/add-edit-category') }}" @else action="{{ url('admin/add-edit-category/' . $category['id']) }}" @endif
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="category_name">Category Name*</label>
                                            <input type="text" class="form-control" id="category_name"
                                                placeholder="Enter Category Name" name="category_name"
                                                @if (!empty($category['category_name'])) value="{{ $category['category_name'] }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_level">Category Level*</label>
                                            <select name="parent_id" class="form-control">
                                                <option value="">Select</option>
                                                <option value="0" @if(empty($category['parent_id'] == 0)) selected @endif>Main Category</option>
                                                @foreach ($getcategories as $cat)
                                                    <option value="{{ $cat['id'] }}">{{ $cat['category_name'] }}</option>
                                                    @if (!empty($cat['subcategories']))
                                                        @foreach ($cat['subcategories'] as $subcat)
                                                            <option value="{{ $subcat['id'] }}">&nbsp; &nbsp; &nbsp;
                                                                &nbsp;>>{{ $subcat['category_name'] }}</option>
                                                            @if (!empty($subcat['subcategories']))
                                                                @foreach ($subcat['subcategories'] as $subsubcat)
                                                                    <option value="{{ $subsubcat['id'] }}">&nbsp; &nbsp;
                                                                        &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>>{{ $subsubcat['category_name'] }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_image">Category Image*</label>
                                            <input type="file" class="form-control" id="category_image"
                                                placeholder="Enter category Image" name="category_image"
                                                @if (!empty($category['category_image'])) value="{{ $category['category_image'] }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_discount">Category Discount*</label>
                                            <input type="text" class="form-control" id="category_discount"
                                                placeholder="Enter category Image" name="category_discount"
                                                @if (!empty($category['category_discount'])) value="{{ $category['category_discount'] }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="url">URL*</label>
                                            <input type="text" class="form-control" id="url"
                                                placeholder="Enter Page URL" name="url"
                                                @if (!empty($category['url'])) value="{{ $category['url'] }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Category Description*</label>
                                            <textarea class="form-control" id="description" rows="3" placeholder="Enter Category Description"
                                                name="description">
@if (!empty($category['description']))
{{ $category['description'] }}
@endif
</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_title">Meta Title*</label>
                                            <input type="text" class="form-control" id="meta_tile"
                                                placeholder="Enter Meta Title" name="meta_title"
                                                @if (!empty($category['meta_title'])) value="{{ $category['meta_title'] }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_description">Meta Description*</label>
                                            <input type="text" class="form-control" id="meta_description"
                                                placeholder="Enter Meta Description" name="meta_description"
                                                @if (!empty($category['meta_description'])) value="{{ $category['meta_description'] }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_keywords">Meta Keywords*</label>
                                            <input type="text" class="form-control" id="meta_keywords"
                                                placeholder="Enter Meta Keywords" name="meta_keywords"
                                                @if (!empty($category['meta_keywords'])) value="{{ $category['meta_keywords'] }}" @endif>
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
