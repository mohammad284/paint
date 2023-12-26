@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
  <?php
  $lang = Session('locale');
  if ($lang != "en") {
      $lang = "ar";
  }
?>
  @if($lang == 'en')
  <link href="{{ asset('assets/massageltr.css') }}" rel="stylesheet" />
  @else
  <link href="{{ asset('assets/massage.css') }}" rel="stylesheet" />
  @endif
@endpush

@section('content')
<!-- Message -->
@if(session()->has('message'))
<p class="message-box" >
    {{ session()->get('message') }}
</p>
@endif
<!-- ./Message -->
    <a type="button" href="/admin/addNewProduct"   class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
        <i class="btn-icon-prepend" ></i>
        {{__('add new product')}}
    </a>
    <div class="example">
      <div class="row">
        @foreach($products as $product)
            <div class="col-12 col-md-6 col-xl-3">
              <div><br></div>
            <div class="card">
                <a  href="/admin/categoryCars/{{$product->id}}">@foreach($product['product_image'] as $image)
                  <img style="height: 160px;" src="{{asset($image->image)}}"  class="card-img-top" alt="..."></a>
                  @break
                  @endforeach
                <div class="card-body">
                  <h4 class="card-title">{{$product->product_name}}</h4>
                  <h5 class="card-title">{{__('price')}}:{{$product->Selling_price}}</h5>
                  <a  title="{{__('edit product')}}" href="/admin/editProduct/{{$product->id}}"> <i data-feather="edit"></i></i></a>
                  <a href="/admin/productDetails/{{$product->id}}" class="btn btn-primary">{{__('product details')}}</a>
                  <a  title="{{__('delete product')}}" href="/admin/deleteProduct/{{$product->id}}"> <i data-feather="trash"></i></i></a>
                </div>
            </div>
            </div>
        @endforeach
      </div>
    </div>
    


    @endsection
	<!-- Message -->
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/prismjs/prism.js') }}"></script>
  <script src="{{ asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
@endpush


