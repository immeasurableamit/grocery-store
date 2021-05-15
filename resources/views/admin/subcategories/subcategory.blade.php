@foreach ($category->children as $sub)
<option value="{{ $sub->id }}">--- {{ $sub->name }}</option>
@include('admin.subcategories.subcategory', ['category' => $sub])
@endforeach
