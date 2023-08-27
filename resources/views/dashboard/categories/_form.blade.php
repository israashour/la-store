<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <x-form.label id="name">Name</x-form.label>
                            <x-form.input name="name" :value=" $category->name "  placeholder="Name" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <x-form.label id="descriptin">Description</x-form.label>
                            <x-form.textarea name="description" value="{{ $category->description }}" placeholder="Description" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <x-form.label id="image">Image</x-form.label>
                            <x-form.input name="image" :value=" $category->image "  placeholder="Name" type="file" accept="image/*" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="h4 mb-3">Category status</h2>
                <div>
                    <x-form.radio name="status" :checked="$category->status" :options="['active' => 'Active', 'unactive' => 'UnActive']" />
                </div>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="parent_id">Category Parent</label>
                    <select name="parent_id" class="form-control">
                        <option value="">Primary Category</option>
                        @foreach ($parents as $parent)
                            <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id) == $parent->id)>
                                {{ $parent->name }}</option>
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
    <a href="{{ route('categories.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
</div>
