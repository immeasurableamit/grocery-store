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

                            <form class="parsley-examples" action="{{ route('categories.update',['category'=>$category->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Name</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Name" name="name" id="name"
                                            value="{{ $category->name }}" class="form-control" required>
                                        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Parent Category</label>
                                    <div class="col-md-9">
                                        <select class="select2 form-control aiz-selectpicker" name="parent_id"
                                            data-toggle="select2" data-placeholder="Choose ..." data-live-search="true"
                                            required>
                                            <option value="">Choose Parent</option>
                                            <option value="0" {{ old('parent_id') == 0 ? 'selected' : '' }}>No Parent
                                            </option>

                                            <!-- Displaying the current category -->
                                            @foreach ($categories->where('parent_id', 0) as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>

                                                <!-- If category has children -->
                                                @if (count($category->children) > 0)
                                                    @foreach ($category->children as $sub)
                                                        <option value="{{ $sub->id }}">-- {{ $sub->name }}</option>
                                                        @include('admin.subcategories.subcategory', ['category' => $sub])
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('parent_id') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">
                                        Ordering Number
                                    </label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="order_level"
                                            value="{{ $category->order_level }}" placeholder="Order Level">
                                        <p> @error('order_level') <span
                                                class="text-danger">{{ $message }}</span>@enderror</p>
                                        <small>Lower number has high priority</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">
                                        Banner (200x200)
                                    </label>

                                    <div class="col-md-9">
                                        <input type="file" class="form-control" name="banner" id="banner" placeholder="Order Level" accept="image/*" onchange="bannerFile(event)">
                                        @error('banner') <span class="text-danger">{{ $message }}</span>@enderror
                                        <img src="{{ asset(CATEGORY_BANNER_IMAGE_URL . '/' . $category->id . '/' . $category->banner) }}" id="banner_prev" width="40px"/>
                                    </div>

                                </div>


                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label" for="signinSrEmail">icon
                                        <small>(32x32)</small></label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" name="icon" accept="image/*" onchange="iconFile(event)">
                                        <img src="{{ asset(CATEGORY_ICON_IMAGE_URL . '/' . $category->id . '/' . $category->icon) }}" id="icon_prev" width="40px"/>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Meta Title</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="meta_title"
                                            value="{{ $category->meta_title }}" placeholder="Meta Title">
                                        @error('meta_title') <span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Meta description</label>
                                    <div class="col-md-9">
                                        <textarea name="meta_description" id="meta_description" rows="5"
                                            class="form-control">{{ $category->meta_description }}</textarea>
                                        @error('meta_description') <span
                                            class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Slug</label>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="Slug" name="slug" id="slug"
                                            value="{{ $category->slug }}" class="form-control">
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
        var bannerFile = function(event) {
          var output = document.getElementById('banner_prev');
          output.src = URL.createObjectURL(event.target.files[0]);
          output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
          }
        };

        var iconFile = function(event) {
          var output = document.getElementById('icon_prev');
          output.src = URL.createObjectURL(event.target.files[0]);
          output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
          }
        };
      </script>

@endsection
