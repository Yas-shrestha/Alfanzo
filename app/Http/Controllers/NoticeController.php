<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notices = Notice::paginate(5);
        return view('resturant.admin.notice.index', compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $files = Files::query()->paginate(30);
        return view('resturant.admin.notice.create', compact('files'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $notice = new Notice;
        $validate_data = $request->validate([
            'title' => 'required',
            'img' => 'required',
            'description' => 'required',
            'sub_title' => 'required',
        ]);
        $notice->title = $validate_data['title'];
        $notice->sub_title = $validate_data['sub_title'];
        $notice->file_id = $validate_data['img'];
        $descriptionContent = $validate_data['description'];
        // Load the HTML content
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true); // Suppress errors due to malformed HTML
        $dom->loadHTML($descriptionContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        // Get all image elements in the description
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            // Check if the src is in base64 format
            if (strpos($src, 'data:image') === 0) {
                // Extract the base64 data
                list($type, $data) = explode(';', $src);
                list(, $data) = explode(',', $data);
                $data = base64_decode($data);

                // Generate a unique filename and save the image
                $imageName = uniqid() . '.png'; // Use PNG or derive from MIME type
                $path = public_path('uploads/' . $imageName);
                file_put_contents($path, $data);

                // Replace the base64 src in the HTML with the new file path
                $img->setAttribute('src', asset('uploads/' . $imageName));
            }
        }

        // Save the modified description back to the database
        $notice->description = $dom->saveHTML();

        // Save the new record
        $notice->save();
        return redirect('admin/notice')->with('success', 'Your data have been submitted');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $notice = new Notice;
        $notice = $notice->where('id', $id)->First();
        $files = Files::query()->paginate(30);
        return view('resturant.admin.notice.show', compact('notice', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $notice = new Notice;
        $notice = $notice->where('id', $id)->First();
        $files = Files::query()->paginate(30);
        return view('resturant.admin.notice.edit', compact('notice', 'files'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $notice = new Notice;
        $notice = $notice->where('id', $id)->First();
        $validate_data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'sub_title' => 'required',
            'img' => 'required',
        ]);
        $notice->title = $validate_data['title'];
        $notice->sub_title = $validate_data['sub_title'];
        $notice->file_id = $validate_data['img'];
        if ($request->has('description') && $request->input('description') !== null) {
            // Delete old images from the previous description
            $this->deleteOldImagesFromDescription($notice->description);

            // Get the new description content
            $descriptionContent = $request->input('description');

            // Load the HTML content of the description
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);  // Suppress errors for malformed HTML
            $dom->loadHTML($descriptionContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            libxml_clear_errors();

            // Process each image in the description
            $images = $dom->getElementsByTagName('img');
            foreach ($images as $img) {
                $src = $img->getAttribute('src');

                // Check if the src is a base64 image
                if (strpos($src, 'data:image') === 0) {
                    // Extract base64 data
                    list($type, $data) = explode(';', $src);
                    list(, $data) = explode(',', $data);
                    $data = base64_decode($data);

                    // Save the base64 image to a file
                    $imageName = uniqid() . '.png';  // Unique name for the image
                    $path = public_path('uploads/' . $imageName);
                    file_put_contents($path, $data);

                    // Update the src attribute to the image URL
                    $img->setAttribute('src', asset('uploads/' . $imageName));
                }
            }

            // Save the updated description with the new image URLs
            $notice->description = $dom->saveHTML();
        }
        $notice->update();
        return redirect('admin/notice')->with('success', 'Your data have been updated');
    }
    protected function deleteOldImagesFromDescription($oldDescription)
    {
        // Find all image URLs in the old description content
        preg_match_all('/src="([^"]+)"/', $oldDescription, $matches);
        $existingImageUrls = $matches[1];  // Extracted image URLs

        // Delete old description images from the filesystem
        foreach ($existingImageUrls as $url) {
            // Get the relative path (by removing base URL)
            $path = str_replace(asset(''), '', $url);
            $fullPath = public_path($path);  // Full path in the public folder

            // If the image exists, delete it
            if (file_exists($fullPath)) {
                unlink($fullPath);  // Delete the image file
            }
        }
    }


    protected function deleteOldImageFromDescription($src)
    {
        // Get the relative path by removing the asset URL part
        $existingImagePath = str_replace(asset(''), '', $src);
        $existingImagePath = public_path($existingImagePath); // Get the full path in the public folder

        // Check if the image exists and delete it
        if (file_exists($existingImagePath)) {
            unlink($existingImagePath); // Delete the image file
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $notice = new Notice;
        $notice = $notice->where('id', $id)->First();
        preg_match_all('/src="([^"]+)"/', $notice->description, $matches);
        $existingImageUrls = $matches[1]; // Array of existing image URLs

        // Remove any image files from the filesystem
        foreach ($existingImageUrls as $existingImageUrl) {
            // Get the relative path by removing the base URL (asset URL)
            $existingImagePath = str_replace(asset(''), '', $existingImageUrl);
            $existingImagePath = public_path($existingImagePath); // Get the full path in the public folder

            // Check if the image exists and delete it
            if (file_exists($existingImagePath)) {
                unlink($existingImagePath); // Delete the description image file
            }
        }
        $notice->delete();
        return redirect('admin/notice')->with('success', 'Your data have been deleted');
    }
}
