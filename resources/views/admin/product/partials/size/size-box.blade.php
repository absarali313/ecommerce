<form method="POST" action="{{ route('admin_size_update', $productSize) }}">
    @csrf
    @method('PUT')
    <div class='row my-2 border border-1 border-white border-top-0 border-start-0 border-end-0 py-3 mt-2 mb-2'>
        <div class='col-10 align-content-center'>
            <div class='col'>
                <label for="size_title" class='text-start text-secondary'>Size Title</label>
                <input id="size_title" name="size_title" class='bg-white-50 border border-opacity-25 border-black rounded-2 px-2 w-10 form-label' placeholder="Small" value={{ $productSize->title }}>

                <x-form-error name="size_title"/>

                <label for="price" class='mx-2 text-start text-secondary'>Price</label>
                <input id="price" name="price" type="number" class='bg-white-50 border border-opacity-25 border-black rounded-2 px-2 w-10 form-label' placeholder="Rs. 1000" value={{ $productSize->getCurrentPrice()->price?? 0 }}>

                <x-form-error name="price"/>

                <label for="stock" class='mx-2 text-start text-secondary'>Stock</label>
                <input id="stock" name="stock" type="number" class='bg-white-50 border border-opacity-25 border-black rounded-2 px-2 w-10 form-label' placeholder="1" value={{ $productSize->stock }}>

                <x-form-error name="price"/>
            </div>
        </div>

        <div class='col-2'>
            <div class='row justify-content-start gap-3'>
                <div class='col-1'>
                    <button class='rounded-3 border-success' name="action" value="update">
                        <li class='fa fa-pen text-success'></li>
                    </button>
                </div>

                <div class='col-1'>
                    <button class='rounded-3 border-secondary 3' name="action" value="delete">
                        <li class='fa fa-trash text-secondary'></li>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
