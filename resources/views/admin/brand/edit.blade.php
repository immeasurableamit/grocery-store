@extends('layouts.admin')
@section('content')



    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Upvex</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                    <li class="breadcrumb-item active">Form Validation</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Category Information</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->



                <div class="row">
                    <div class="col-lg">
                        <div class="card-box">
                            <h4 class="header-title">Category Information</h4>
                            <hr>

                            <form class="parsley-examples" action="{{ route('brands.update',['brand'=>$brand->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Name</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Name" name="name" id="name"
                                            value="{{ $brand->name }}" class="form-control" required>
                                        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>



                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">
                                        Logo (120*80)
                                    </label>

                                    <div class="col-md-9">
                                        <input type="file" class="form-control" name="logo" id="logo" accept="image/*" onchange="brandrFile(event)">
                                        @error('logo') <span class="text-danger">{{ $message }}</span>@enderror
                                        <img src="{{ asset(BRAND_LOGO_IMAGE_URL . '/' . $brand->id . '/' . $brand->banner) }}" id="logo_prev" width="40px"/>
                                    </div>

                                </div>




                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Meta Title</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="meta_title"
                                            value="{{ $brand->meta_title }}" placeholder="Meta Title">
                                        @error('meta_title') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Meta description</label>
                                    <div class="col-md-9">
                                        <textarea name="meta_description" id="meta_description" rows="5"
                                            class="form-control">{{ $brand->meta_description }}</textarea>
                                        @error('meta_description') <span
                                            class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Slug</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Slug" name="slug" id="slug"
                                            value="{{ $brand->slug }}" class="form-control">
                                        @error('slug') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="form-group mb-0 text-right">
                                    <button type="submit" class="btn btn-danger waves-effect waves-light"
                                    data-overlayColor="#38414a">Save</button>
                                </div>
                            </form>
                        </div> <!-- end card-box -->

                    </div> <!-- end col -->
                    <!-- end col -->

                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

    </div>



    <script>
        var brandrFile = function(event) {
          var output = document.getElementById('logo_prev');
          output.src = URL.createObjectURL(event.target.files[0]);
          output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
          }
        };


      </script>

@endsection
