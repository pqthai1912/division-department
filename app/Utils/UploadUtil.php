<?php

namespace App\Utils;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UploadUtil
{
    /**
     * Handle the image upload process.
     *
     * @param Request $request The HTTP request containing the image file.
     * @param int $id The identifier used for naming the image.
     * @param string|null $path The destination path where the image will be stored.
     * @param string|null $fileName The name of the file input in the request.
     * @return array An associative array containing the file name and its path.
     */
    public static function handleUploadImage(Request $request, $id, ?string $path, ?string $fileName)
    {
        // Check if the image file is uploaded
        if ($request->hasFile($fileName)) {
            // Check if there is a hidden image input for updating

            if ($request->input('hidden_image')) {
                // Remove the leading slash and delete the old image
                $destinationFile = substr($request->input('hidden_image'), 1);
                if (File::exists($destinationFile)) {
                    File::delete($destinationFile);
                }
            }

            $inputImage = $request->file($fileName);

            // Get the original extension of the uploaded image
            $extension = $inputImage->getClientOriginalExtension();

            // Rename the file with a unique name using date, ID, and a random string
            $newFileName = date('YmdHis') . '_' . $id . '_' . Str::random(7) . "." . $extension;

            // Move the uploaded image to the specified path
            $inputImage->move($path, $newFileName);

            // Construct the image path name
            $imagePathName = "/{$path}{$newFileName}";

            return [$fileName => $imagePathName];
        }

        // Return an empty array if no image file was uploaded
        return [];
    }

    public static function uploadCSV(Request $request, $path, $nameScreen, ?string $fileName)
    {
        // Check file has uploaded
        if ($request->hasFile($fileName)) {
            $input = $request->file($fileName);

            $extension = $input->getClientOriginalExtension();

            $subPath = '/' . date('Y') . '/' . date('m'). '/' . date('d'). '/';
            // rename file, id of account creating/updating, not logging.
            $newFileName = date('YmdHis').'_'.
            $nameScreen . '.' . $extension; // format by description

            $input->move($path.$subPath, $newFileName);
        }
    }
}
