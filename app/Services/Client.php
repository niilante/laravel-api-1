<?php

namespace App\Services;

use App\Facades\Authenticate\Authenticate;

class Client
{
    /**
     * get client finger print for request
     *
     * @return string
     */
    public static function fingerPrint(): string
    {
        $request = request();

        return crc32(sha1(serialize(json_encode([
            $request->method(),
            $request->url(),
            $request->query->all(),
            $request->request->all(),
            $request->ip(),
            Authenticate::code()
        ]))));
    }

    /**
     * get client data
     *
     * @return array
     */
    public static function data() : array
    {
        if(AppContainer::has('clientData')){
            $clientData = AppContainer::get('clientData');

            if(request()->method()==='GET'){
                return $clientData['params'] ?? [];
            }

            return $clientData['body'] ?? [];
        }

        if(request()->method()==='GET'){
            return request()->query->all();
        }

        return request()->request->all();
    }

    /**
     * get content type for client
     *
     * @param bool $format
     * @return string
     */
    public static function contentType($format = false) : string
    {
        $default            = 'application/'.config('app.defaultApiResponseFormatter');
        $contentType        = AppContainer::get('contentType');
        $validContentTypes  = AppContainer::get('validContentTypes');

        if($format){
            return $validContentTypes[$contentType] ?? $default;
        }

        return $contentType ?? $default;
    }
}
