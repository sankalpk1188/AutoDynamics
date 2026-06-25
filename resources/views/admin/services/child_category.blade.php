@php
    $value = null;
    for ($i=0; $i < $child_category->level; $i++){
        $value .= '--';
    }
@endphp
<option value="{{ $child_category->id }}">{{ $value." ".$child_category->title }}</option>
@if ($child_category->category)
    @foreach ($child_category->category as $childCategory)
        @include('admin.services.child_category', ['child_category' => $childCategory])
    @endforeach
@endif