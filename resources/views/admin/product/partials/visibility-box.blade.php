<div class="row bg-white rounded-3 px-3 py-2 border border-1 border-white">
    <div class="col">
        <div class="row">
            <div class="col">
                <label for="visibility" class="text-start text-secondary">Visibility</label>

                <select id="visibility" name="visibility" class="form-select">
                    <option value="active" @selected($product?->isVisible())>Active</option>
                    <option value="inactive" @selected($product?->isHidden())>Inactive</option>
                </select>

                <x-form-error name="visibility"/>
            </div>
        </div>
    </div>
</div>
