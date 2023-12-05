<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *   description="Contoh API doc menggunakan OpenAPI/Swagger",
 *   version="0.0.1",
 *   title="Contoh API documentation",
 *   termsOfService="http://swagger.io/terms/",
 *   @OA\Contact(
 *     email="choirudin.emchagmail.com"
 *   ),
 *   @OA\License(
 *     name="Apache 2.0",
 *     url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *   )
 * )
 */

class GreetController extends Controller
{
    /**
     * @OA\Get(
     *   path="/api/greet",
     *   tags={"greeting"},
     *   summary="Returns a Sample API response",
     *   description="A sample greeting to test out the API",
     *   operationId="greet",
     *   @OA\Parameter(
     *     name="firstname",
     *     description="nama depan",
     *     required=true,
     *     in="query",
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="lastname",
     *     description="nama belakang",
     *     required=true,
     *     in="query",
     *     @OA\Schema(
     *       type="string"
     *     )
     *   ),
     *   @OA\Response(
     *     response="default",
     *     description="successful operation"
     *   )
     * )
     */
    public function greet(Request $request)
    {
        $userData = $request->only([
            'firstname',
            'lastname',
        ]);

        if (empty($userData['firstname']) && empty($userData['lastname'])) {
            return new \Exception('Missing data', 404);
        }

        return 'Halo ' . $userData['firstname'] . ' ' . $userData['lastname'];
    }

    /**
     * @OA\Get(
     *   path="/api/gallery",
     *   tags={"gallery"},
     *   summary="Returns a list of gallery images",
     *   description="Returns a paginated list of gallery images where pictures are not empty",
     *   operationId="getGallery",
     *   @OA\Response(
     *     response="200",
     *     description="Successful operation"
     *   )
     * )
     */
    public function getPicture()
    {
        $data = Post::all();
        $picture = [];

        foreach ($data as $item) {
            $detail = [
                'id' => $item->id,
                'title' => $item->title,
                'description' => $item->description,
                'picture' => $item->picture,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
            array_push($picture, $detail);
        }

        return response()->json($picture);
    }

    /**
     * @OA\Post(
     *   path="/api/postPhoto",
     *   tags={"Post Photo"},
     *   summary="Upload a photo",
     *   description="Endpoint to upload a photo with title and description",
     *   operationId="postPhoto",
     *   @OA\Response(
     *     response="default",
     *     description="Successful operation"
     *   )
     * )
     */
    public function storePicture(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'picture' => 'image|nullable|max:1999'
        ]);

        $image = $request->only([
            'title',
            'description',
            'picture'
        ]);

        if (empty($image['title']) && empty($image['description']) && empty($image['picture'])) {
            return new \Exception('Data belum lengkap', 400);
        }

        if ($request->hasFile('picture')) {
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $basename = uniqid() . time();
            $smallFilename = "small_{$basename}.{$extension}";
            $mediumFilename = "medium_{$basename}.{$extension}";
            $largeFilename = "large_{$basename}.{$extension}";
            $filenameSimpan = "{$basename}.{$extension}";
            $path = $request->file('picture')->storeAs('posts_image', $filenameSimpan);
        } else {
            $filenameSimpan = 'noimage.png';
        }

        $post = new Post;
        $post->picture = $filenameSimpan;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();

        // return response()->json(['message' => 'Data berhasil disimpan', 'success' => true], 200);
        return redirect()->route('gallery.index');
    }
}