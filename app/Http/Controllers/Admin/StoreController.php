<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request = request();
        $stores = Store::with('products')
        ->withCount([
            'products' => function($query) {
                $query->where('status', '=', 'active');
            }
        ])
        ->filter($request->query())
        ->paginate();

        return view('dashboard.stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $store = new Store();
        return view('dashboard.stores.create', compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $clean_data = $request->validate(Store::rules(), [
            'required' => 'This field is required!',
            'unique' => 'This name is already exists!'
        ]);

        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);

        $data = $request->except(['logo_image', 'cover_image']);
        $data[['logo_image', 'cover_image']] = $this->uploadImage($request);

        $store = Store::create($request->all());

        return Redirect::route('stores.index')->with('success', 'Store created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        return view('dashboard.stores.show', [
            'store' => $store
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $store = Store::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('stores.index')->with('info', 'Record not found!');
        }

        return view('dashboard.stores.edit', compact('store'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $store = Store::find($id);

        $old_image = $store->image;
        $data = $request->except(['logo_image', 'cover_image']);
        $new_image = $this->uploadImage($request);
        if($new_image){
            $data[['logo_image', 'cover_image']] = $new_image;
        }

        $store->update($data);

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        return Redirect::route('stores.index')->with('success', 'Store Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $store = Store::findOrFail($id);

        $deleted = $store->delete();

        if ($deleted) {
            return redirect()->route('stores.index')->with('success', 'Store deleted successfully!');
        } else {
            return HttpResponse::HTTP_BAD_REQUEST;
        }
    }

    protected function uploadImage(Request $request)
    {
        if(!$request->hasFile('image')){
            return;
        }

        $file = $request->file('image');
        $path = $file->store('uploads/stores', [
            'disk' => 'public'
        ]);
        return $path;
    }

    public function trash()
    {
        $stores = Store::onlyTrashed()->paginate();
        return view('dashboard.stores.trash', compact('stores'));
    }

    public function restore(Request $request, $id)
    {
        $store = Store::onlyTrashed()->findOrFail($id);
        $store->restore();

        return redirect()->route('stores.trash')->with('success', 'Store restored!');
    }

    public function forceDelete($id)
    {
        $store = Store::onlyTrashed()->findOrFail($id);
        $store->forceDelete();

        if($store->image){
            Storage::disk('public')->delete($store->image);
        }

        return redirect()->route('stores.trash')->with('success', 'Store Deleted!');
    }
}

