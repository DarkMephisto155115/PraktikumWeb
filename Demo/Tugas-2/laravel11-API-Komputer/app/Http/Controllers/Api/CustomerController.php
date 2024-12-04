<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        // Get all posts
        $posts = Customer::latest()->paginate(5);

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
            'nama'        => 'required',
            'email'    => 'required',
            'alamat' => 'required',
            'no_hp'       => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create post
        $post = Customer::create([
            'nama'        => $request->nama,
            'email'    => $request->email,
            'alamat'       => $request->alamat,
            'no_hp'        => $request->no_hp,
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
        $post = Customer::find($id);

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
            'email'    => 'required',
            'alamat' => 'required',
            'no_hp'       => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find post by ID
        $post = Customer::find($id);

        $post->update([
            'nama'        => $request->nama,
            'email'    => $request->email,
            'alamat'       => $request->alamat,
            'no_hp'        => $request->no_hp,
        ]);


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
        $post = Customer::find($id);

        // Delete post
        $post->delete();

        // Return response
        return new PostResource(true, 'Data Post Berhasil Dihapus!', null);
    }
}
