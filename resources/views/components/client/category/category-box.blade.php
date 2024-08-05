@props(['item'=> null])


<div class="col-md-3 mb-4">

    <div class="card shadow-sm h-100">

        <img src="http://picsum.photos/seed/{{rand(0,10000)}}/100/100" class="card-img-top rounded"
             alt="Placeholder Image">

        <div class="card-body text-center">

            <a href="{{route('category.products', $item)}}" class="text-black text-decoration-none"><h5
                    class="card-title mb-2">{{$item->name}}</h5></a>
            <a href="{{route('category.products', $item)}}" class="btn text-white bg-black border-dark text-center">Browse
                Category</a>

        </div>

    </div>

</div>
