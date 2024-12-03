<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        // Get all posts
        $posts = Product::latest()->paginate(5);

        // Return collection of posts as a resource
        return new PostResource(true, 'List Data Posts', $posts);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama'        => 'required',
            'kategori'    => 'required',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
            'dibeli'      => 'required|integer',
            'description' => 'required',
            'brand'       => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Upload image
        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());

        // Create post
        $post = Product::create([
            'image'       => $image->hashName(),
            'nama'        => $request->nama,
            'kategori'    => $request->kategori,
            'harga'       => $request->harga,
            'stok'        => $request->stok,
            'dibeli'      => $request->dibeli,
            'description' => $request->description,
            'brand'       => $request->brand,
        ]);

        // Return response
        return new PostResource(true, 'Data Post Berhasil Ditambahkan!', $post);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        // Find post by ID
        $post = Product::find($id);

        // Return single post as a resource
        return new PostResource(true, 'Detail Data Post!', $post);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'nama'        => 'required',
            'kategori'    => 'required',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
            'dibeli'      => 'required|integer',
            'description' => 'required',
            'brand'       => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find post by ID
        $post = Product::find($id);

        // Check if image is not empty
        if ($request->hasFile('image')) {
            // Upload new image
            $image = $request->file('image');
            $image->storeAs('public/products', $image->hashName());

            // Delete old image
            Storage::delete('public/products/' . basename($post->image));

            // Update post with new image
            $post->update([
                'image'       => $image->hashName(),
                'nama'        => $request->nama,
                'kategori'    => $request->kategori,
                'harga'       => $request->harga,
                'stok'        => $request->stok,
                'dibeli'      => $request->dibeli,
                'description' => $request->description,
                'brand'       => $request->brand,
            ]);
        } else {
            // Update post without image
            $post->update([
                'nama'        => $request->nama,
                'kategori'    => $request->kategori,
                'harga'       => $request->harga,
                'stok'        => $request->stok,
                'dibeli'      => $request->dibeli,
                'description' => $request->description,
                'brand'       => $request->brand,
            ]);
        }

        // Return response
        return new PostResource(true, 'Data Post Berhasil Diubah!', $post);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        // Find post by ID
        $post = Product::find($id);

        // Delete image
        Storage::delete('public/products/' . basename($post->image));

        // Delete post
        $post->delete();

        // Return response
        return new PostResource(true, 'Data Post Berhasil Dihapus!', null);
    }
}
