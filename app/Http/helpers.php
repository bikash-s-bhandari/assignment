<?php
function upload_image(\Illuminate\Http\UploadedFile $image, $path)
{
    // modify the image name and upload it and return modified image name.
    $image_name_with_extension = $image->getClientOriginalName();
    $modified_image_name_with_extension = date('YmdHis') . "-" . str_random(5) . "-" . str_replace(" ", "-", $image_name_with_extension);
    $image_path = public_path('uploads/') . $path;

    if ($image->move($image_path, $modified_image_name_with_extension)) {
        return $modified_image_name_with_extension;
    } else {
        return redirect()->back()->with('failure_message', 'Sorry, something went wrong while uploading the image. Please try again later!');
    }
}

function admin_url_material($url)
{
    return asset("admin_material/" . $url);
}

function material_dashboard_url($url)
{
    return asset("material_dashboard/" . $url);
}

function bsb_str_slug($str)
{
    $str_final = str_replace('&', 'and', $str);

    return str_slug($str_final) . '-' . date('YmdHis');

}
