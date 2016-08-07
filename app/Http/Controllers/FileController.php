<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;
use App\Http\Requests;

class FileController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    // partial reference: https://cwhite.me/avoiding-the-burden-of-file-uploads/
    public function sign(Request $request)
    {
        $s3Client = Storage::disk('s3')->getAdapter()->getClient();
        $bucket = config('filesystems.disks.s3.bucket');
        $fileName = $request->input('fileName');
        
        $cmd = $s3Client->getCommand('PutObject', [
          'Bucket' => $bucket,
          'Key'    => $fileName,
          'ACL' => 'public-read',
          'Body' => ''
        ]);

        $request = $s3Client->createPresignedRequest($cmd, '+1 minute');
        $signedRequest = (string) $request->getUri();
        
        return [
            'downloadUrl' => $s3Client->getObjectUrl($bucket, $fileName),
            'signedRequest' => $signedRequest,
            'uploadURL' => 'https://'.$bucket.'.s3.amazonaws.com/'+$fileName,
        ];
    }

}
