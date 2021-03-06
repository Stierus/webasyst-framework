<?php

class photosFrontendPhoto
{
    public static function getLink($photo, $album = null)
    {
        static $wa = null;
        $wa = $wa ? $wa : wa();

        $link = null;
        if (is_null($album)) {
            $link = $wa->getRouteUrl('photos/frontend/photo', array(
                'url' => $photo['url'].(isset($photo['status']) && $photo['status'] <= 0 ? ':'.$photo['hash'] : '')
            ), true);
        } else if (is_array($album)) {
            $link = $wa->getRouteUrl('photos/frontend/photo', array(
                'url' => $album['full_url'].'/'.$photo['url']
            ), true);
        } else {
            $hash = $album;
            if (substr($hash, 0, 1) == '#') {
                $hash = substr($hash, 1);
            }
            $hash = trim($hash, '/');
            $hash = explode('/', $hash);

            $params = array(
                'url' => $photo['url']
            );
            if (count($hash) >= 2) {
                $params[$hash[0]] = $hash[1];
            } else if (count($hash) == 1) {
                $params[$hash[0]] = $hash[0];
            }
            $link = $wa->getRouteUrl('photos/frontend/photo', $params, true);
        }
        return $link ? rtrim($link, '/').'/' : null;
    }
}