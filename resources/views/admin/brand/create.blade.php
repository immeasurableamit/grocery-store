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

                            </div>
                            <h4 class="page-title">Add New Brand</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->



                <div class="row">
                    <div class="col-lg">
                        <div class="card-box">
                            <h4 class="header-title">Add New Brand</h4>
                            <hr>

                            <form class="parsley-examples" action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Name</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Name" name="name" id="name"
                                            value="{{ old('name') }}" class="form-control">
                                        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">
                                        Logo (120*80)
                                    </label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" name="logo" id="logo">
                                        @error('logo') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Meta Title</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="meta_title"
                                            value="{{ old('meta_title') }}" placeholder="Meta Title">
                                        @error('meta_title') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Meta description</label>
                                    <div class="col-md-9">
                                        <textarea name="meta_description" id="meta_description" rows="5"
                                            class="form-control">{{ old('meta_description') }}</textarea>
                                        @error('meta_description') <span
                                            class="text-danger">{{ $message }}</span>@enderror
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


@endsection
