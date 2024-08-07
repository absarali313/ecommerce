<div class="container-fluid my-5 ">
    <form method="POST" action="{{ route('admin.category.store') }}">
        @csrf
        <div class="row d-flex justify-content-around ">
            <div class="col-6">
                <h4>Add Category</h4>
            </div>

            <div class="col-6 d-flex justify-content-end ">
                <a href="/admin/categories" class="btn btn-red rounded-2 mx-1 ">Cancel</a>
                <button type="submit" class="btn btn-gray rounded-2 mx-1 ">Save</button>
            </div>
        </div>

        <div class="row d-flex justify-content-around mt-1 p-1 ">
            <div class="col-7">

                <x-admin.Category.category-create-description-box/>
            </div>

            <div class="col-3">
                <div class="row bg-white rounded-3 px-3 py-2 border border-1 border-white">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <label for="parent" class="text-start text-secondary">Parent Category</label>
                                <select id="parent" name="parent" class="form-select">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->name }}" >{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                <x-form-error name="parent" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
