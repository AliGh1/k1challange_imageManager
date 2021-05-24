<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Http\Requests\ImageUpdateRequest;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::latest()->paginate(5);
        return view('images', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(ImageRequest $request, Image $image)
    {
        $file = $request->file('image');

        // create new random name
        $name = \Str::random(12) . '.' . $file->getClientOriginalExtension();

        $destinationPatch = '/images/' . now()->year . '/' . now()->month . '/' . now()->day . '/';


        // get image size (kb)
        $size = round($file->getSize() / 1024);

        // get image width and height
        list($width, $height) = getimagesize($file);

        // save image
        $file->move(public_path($destinationPatch), $name);

        // image src
        $src = public_path($destinationPatch) . $name;
        // thumbnail src
        $dest = public_path($destinationPatch) . 'thumbnail_'. $name;

        Image::resize_crop_image(300, 200, $src, $dest);

        // image relative patch
        $patch = $destinationPatch . $name;

        // Thumbnail relative patch
        $thumb = $destinationPatch . 'thumbnail_' . $name;

        $image->create([
           'title' => $request->title,
           'alt' => $request->alt,
           'image' =>  $patch,
           'thumbnail' => $thumb,
           'dimensions' => $width . '*' . $height,
           'size' => $size
        ]);

        return redirect(route('image.index'))->with(['status' => 'Image create Successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        return view('show-image', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        return view('edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ImageUpdateRequest $request
     * @param \App\Models\Image $image
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(ImageUpdateRequest $request, Image $image)
    {
        $image->update([
            'title' => $request->title,
            'alt' => $request->alt
        ]);

        return redirect(route('image.index'))->with(['status' => 'Image Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Image $image)
    {
        if(\File::exists(public_path($image->image)))
            \File::delete(public_path($image->image));

        if(\File::exists(public_path($image->thumbnail)))
            \File::delete(public_path($image->thumbnail));

        $image->delete();

        return redirect(route('image.index'))->with(['status' => 'Image Deleted Successfully']);
    }
}
