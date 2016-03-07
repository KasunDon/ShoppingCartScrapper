<?php

namespace HTTP;

/**
 * HTTPClientInterface
 */
interface DownloaderInterface {
    
    public function download($uri);
}