<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use League\CommonMark\Inline\Element\Image;
use Intervention\Image\Facades\Image as ImageInt;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('welcome');
    }

    private function saveCroppedImage(&$img, $extension, $width, $height, $x, $y)
    {
        $this->img = $img;
        $filename = Str::random(40) . '.' . $extension ?: 'png';;
        $path = public_path() . '/' . 'photos/';

        $copy_of_object = clone $img;
        $copy_of_object->crop((int)$width, (int)$height, (int)$x, (int)$y);
        $copy_of_object->save($path . $filename);

        $copy_of_object = null;
        return $filename;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        $path = public_path() . '/' . 'photos/';
        $file = $request->file('img');
        $img = ImageInt::make($file);
        $extension = strtolower($file->getClientOriginalExtension());
        if($img->filesize()>30*1024*1024 || !in_array($extension,['png', 'jpg', 'jpeg', 'tiff'])){
            return ('Size or extension is not correct');
        }

        $filename = Str::random(40) . '.' . $extension ?: 'png';

        $img->save($path . $filename);
        $width = $img->getWidth();
        $height = $img->getHeight();
        $imgArr = [];
        $imgArr[] = $filename;

        //1
        $imgCroped = $this->saveCroppedImage($img, $extension, ($width / 100 * 18), ($height / 100 * 40),
            ($width / 100 * 3),
            ($height / 100 * 30));

        $imgArr[0] = $imgCroped;
        //2
        $imgCroped = $this->saveCroppedImage($img, $filename, ($width / 100 * 18), ($height / 100 * 60),
            ($width / 100 * 22),
            ($height / 100 * 20));

        $imgArr[1] = $imgCroped;
        //3
        $imgCroped = $this->saveCroppedImage($img, $filename, ($width / 100 * 18), ($height / 100 * 90),
            ($width / 100 * 41),
            ($height / 100 * 5));
        $imgArr[2] = $imgCroped;
        //4
        $imgCroped = $this->saveCroppedImage($img, $filename, ($width / 100 * 18), ($height / 100 * 60),
            ($width / 100 * 60),
            ($height / 100 * 20));
        $imgArr[3] = $imgCroped;
        //5
        $imgCroped = $this->saveCroppedImage($img, $filename, ($width / 100 * 18), ($height / 100 * 40),
            ($width / 100 * 79),
            ($height / 100 * 30));
        $imgArr[4] = $imgCroped;


//        dd(2,$img->filesize());     //Размер изображения

        return view('show', compact('imgArr', 'filename'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($img)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
