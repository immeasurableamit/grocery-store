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
                            <h4 class="page-title">Brands Information</h4>
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
                                        <a href="{{ route('brands.create') }}" class="btn btn-danger waves-effect waves-light"
                                             data-overlayColor="#38414a"><i
                                                class="mdi mdi-plus-circle mr-1"></i> Add New Brands</a>
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
                                            <th>Logo</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($brands as $brand)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $brand->name }}</td>

                                                <td><img src="{{ asset(BRAND_LOGO_IMAGE_URL . '/' . $brand->id . '/' . $brand->logo) }}" alt=""  class="rounded-circle avatar-xs"></td>

                                                <td>
                                                    <a href="{{ route('brands.edit',['brand'=>$brand->id]) }}"><i class="fa fa-edit btn btn-success" aria-hidden="true"></i></a>

                                                    <form action="{{ route('brands.destroy',['brand'=>$brand->id]) }}" method="POST">
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
