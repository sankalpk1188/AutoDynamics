@php 
    $url = url()->current(); 
    $serviceCats = App\Models\ServiceCategory::with('services')->where('id',$service_cat_id)->first();
@endphp

<h5 class="color-brand-1 mb-15 border-bottom color-brand-1 mb-15 pb-10 pt-0">{{$serviceCats->name}}</h5>
<ul class="list-terms list-style-none">
    @foreach($serviceCats->services as $serv)
    <li @if(preg_match('#'.Str::slug($serv->title).'#', $url)) class="active" @endif>
        <a href="{{url('/services/'.$serv->id.'/'.Str::slug($serviceCats->name).'/'.Str::slug($serv->title))}}">{{$serv->title}}</a>
    </li>
    @endforeach
</ul>