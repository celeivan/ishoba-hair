<div class="productCards row row-cols-1 row-cols-md-2 row-cols-lg-4">
    @foreach($products as $product)
    <div class="col">
        <div class="card border-0 h-100">
            <div class="flex-grow-1 d-flex my-0 mx-auto align-items-end"><img src="{{$product['imageUrl']}}" alt="Card image cap"></div>
            <a class="text-center" href="#">Read More</a>
        </div>
    </div>
    @endforeach
</div>