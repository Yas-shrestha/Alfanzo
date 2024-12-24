<?php

namespace App\Http\Controllers;

use App\Models\DiningSpace;
use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class DiningSpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spaces = DiningSpace::paginate(5);
        return view('resturant.admin.DiningSpaces.index', compact('spaces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $files = Files::query()->paginate(30);
        return view('resturant.admin.DiningSpaces.create', compact('files'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create a new DiningSpace instance
        $spaces = new DiningSpace;

        // Validate the request
        $validate_data = $request->validate([
            'title' => 'required|string',
            'nooftables' => 'required|string',
            'description' => 'required|string', // Rich text content with images
            'img' => 'required', // Assuming 'img' is the file ID
        ]);

        // Save basic fields
        $spaces->title = $validate_data['title'];
        $spaces->nooftables = $validate_data['nooftables'];
        $spaces->file_id = $validate_data['img'];

        // Process the 'description' content to handle images
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
        $spaces->description = $dom->saveHTML();

        // Save the new record
        $spaces->save();

        return redirect('admin/spaces')->with('success', 'Your data has been submitted');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $spaces = new DiningSpace;
        $space = $spaces->where('id', $id)->First();
        $files = Files::query()->paginate(30);
        return view('resturant.admin.DiningSpaces.show', compact('space', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $spaces = new DiningSpace;
        $space = $spaces->where('id', $id)->First();
        $files = Files::query()->paginate(30);
        return view('resturant.admin.DiningSpaces.edit', compact('space', 'files'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $spaces = DiningSpace::findOrFail($id);

        // Validate the input
        $request->validate([
            'title' => 'required|string',
            'nooftables' => 'required|string',
            'img' => 'nullable|exists:files,id',  // Ensure the img ID exists in the files table
            'description' => 'nullable|string',  // Validate description as string
        ]);

        // Update the title
        $spaces->title = $request->input('title');
        $spaces->nooftables = $request->input('nooftables');

        // If img_id is provided, update the file_id (image)
        if ($request->has('img') && $request->input('img') !== null) {
            $spaces->file_id = $request->input('img');  // Update file_id to the provided img_id
        }

        // Handle description if it has base64 images
        if ($request->has('description') && $request->input('description') !== null) {
            // Delete old images from the previous description
            $this->deleteOldImagesFromDescription($spaces->description);

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
            $spaces->description = $dom->saveHTML();
        }

        // Save the updated DiningSpace record
        $spaces->save();

        return redirect('/admin/spaces')->with('success', 'Space updated successfully!');
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


    public function destroy($id)
    {
        // Find the DiningSpace by ID
        $spaces = DiningSpace::findOrFail($id);

        // Delete the associated image file (if necessary)
        // Here assuming 'file_id' links to a file in the public directory
        $file = File::find($spaces->file_id);
        if ($file) {
            $filePath = public_path('uploads/' . $file->filename); // Assuming files are stored in 'uploads' directory
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the image file
            }
        }

        // Optionally delete images referenced in the description
        preg_match_all('/src="([^"]+)"/', $spaces->description, $matches);
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

        // Delete the dining space record
        $spaces->delete();

        return redirect('admin/spaces')->with('success', 'Your data has been deleted');
    }
}
