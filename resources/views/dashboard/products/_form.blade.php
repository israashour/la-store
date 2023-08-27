<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <x-form.label id="name">Name</x-form.label>
                            <x-form.input name="name" :value="$product->name" placeholder="Name" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <x-form.label id="descriptin">Description</x-form.label>
                            <x-form.textarea name="description" value="{{ $product->description }}"
                                placeholder="Description" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <x-form.label id="image">Image</x-form.label>
                            <x-form.input name="image" :value="$product->image" placeholder="Name" type="file"
                                accept="image/*" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <x-form.label id="price">Price</x-form.label>
                        <x-form.input name="price" value="{{ $product->price }}" placeholder="Price" />
                    </div>
                    <div class="col-md-6">
                        <x-form.label id="compare_price">Compare price</x-form.label>
                        <x-form.input name="compare_price" value="{{ $product->compare_price }}"
                            placeholder="Compare price" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="h4 mb-3">Product status</h2>
                <div>
                    <x-form.radio name="status" :checked="$product->status" :options="['active' => 'Active', 'unactive' => 'UnActive']" />
                </div>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <x-form.label id="featured">Featured product?</x-form.label>
                <x-form.radio name="features" :checked="$product->featured" :options="['1' => 'Yes', '0' => 'No']" />
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="parent_id">Store</label>
                    <select name="parent_id" class="form-control">
                        <option value="">No store</option>
                        @foreach ($stores as $item)
                            <option value="{{ $item->id }}" @selected(old('store_id', $product->store_id) == $item->id)>
                                {{ $item->name }}</option>
                        @endforeach
                        @error('parent_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </select>
                </div>
                <div class="mb-3">
                    <label for="parent_id">Category</label>
                    <select name="parent_id" class="form-control">
                        <option value="">No category</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}" @selected(old('category_id', $product->category_id) == $item->id)>
                                {{ $item->name }}</option>
                        @endforeach
                        @error('parent_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pb-5 pt-3">
    <button class="btn btn-primary">{{ $button_label ?? 'Save' }}</button>
    <a href="{{ route('products.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
</div>
