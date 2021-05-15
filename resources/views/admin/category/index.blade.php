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
                    <div class="col-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-lg-8">
                                    <form class="form-inline">
                                        <div class="form-group">
                                            <label for="inputPassword2" class="sr-only">Search</label>
                                            <input type="search" class="form-control" name="keyword"
                                                placeholder="Search...">
                                        </div>
                                        <div class="form-group mx-sm-3">
                                            <label for="status-select" class="mr-2">Sort By</label>
                                            <select class="custom-select" id="status-select">
                                                <option selected="">All</option>
                                                <option value="1">Name</option>
                                                <option value="2">Job Success</option>
                                                <option value="3">Total Earned</option>
                                                <option value="4">Hours Worked</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-4">
                                    <div class="text-lg-right mt-3 mt-lg-0">
                                        <a href="{{ route('categories.create') }}" class="btn btn-danger waves-effect waves-light"
                                             data-overlayColor="#38414a"><i
                                                class="mdi mdi-plus-circle mr-1"></i> Add New Category</a>
                                    </div>
                                </div><!-- end col-->
                            </div> <!-- end row -->
                        </div> <!-- end card-box -->
                    </div><!-- end col-->
                </div>
                <!-- end row -->





                <div class="row">
                    <div class="col">
                        <div class="card-box">

                            <div class="table-responsive">
                                <table class="table table-sm mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Parent Category</th>
                                            <th>Order Level</th>
                                            <th>Level</th>
                                            <th>Banner</th>
                                            <th>Icon</th>
                                            <th>Featured</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $category)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $category->name }}</td>

                                                @if ($category->parent_id != 0)
                                                <td>{{ $category->parent ->name}}</td>
                                                @else
                                                <td>-</td>
                                                @endif

                                                <td>{{ $category->order_level }}</td>
                                                <td>{{ $category->level }}</td>



                                                <td><img src="{{ asset(CATEGORY_BANNER_IMAGE_URL . '/' . $category->id . '/' . $category->banner) }}" alt=""  class="rounded-circle avatar-xs"></td>

                                                <td><img src="{{ asset(CATEGORY_ICON_IMAGE_URL . '/' . $category->id . '/' . $category->icon) }}" alt="" class="rounded-circle avatar-xs"></td>

                                                <td>
                                                    <div class="custom-control custom-switch mb-2">
                                                        <input type="checkbox" class="custom-control-input" id="featured" onchange="enableTxt(this)" >
                                                        <label class="custom-control-label" for="featured"></label>
                                                    </div>
                                                </td>

                                                <script>
                                                    function enableTxt(elem) {
                                                        var id = $(elem).attr("id");
                                                        alert(id);
                                                    }
                                                </script>

                                                <td>

                                                    <a href="{{ route('categories.edit',['category'=>$category->id]) }}"><i class="fa fa-edit btn btn-success" aria-hidden="true"></i></a>

                                                    <form action="{{ route('categories.destroy',['category'=>$category->id]) }}" method="POST">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button class="btn btn-danger m-1"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </form>
                                                </td>

                                            </tr>
                                            @empty

                                        @endforelse

                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive-->

                            {{-- @include('pagination.default', ['paginator' => $categories]) --}}


                        </div> <!-- end card-box -->
                    </div> <!-- end col -->

                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->
        </div>

    @endsection
