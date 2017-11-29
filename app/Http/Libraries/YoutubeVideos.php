<?php
    namespace Libraries;
    Class YoutubeVideos
    {
        function __construct() {

        }
        public static function getPlayListIdFromChannelId($key, $channelId){
            // recupera el identificador de la lista de uploads del canal.
            $url_channel = "https://www.googleapis.com/youtube/v3/channels?id=".$channelId."&part=contentDetails&key=".$key;
            $json_channel = json_decode(file_get_contents($url_channel), true);
            $playlistId = $json_channel['items'][0]['contentDetails']['relatedPlaylists']['uploads'];
            return $playlistId;
        }

        public static function getChannelVideos($key, $channelId){
            // recupera el json con los datos de los videos
            $playlistId = self::getPlayListIdFromChannelId($key, $channelId);
            $url_videos = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=8&playlistId=".$playlistId."&key=".$key;
            $json = json_decode(file_get_contents($url_videos), true);

            // procesamos la primera pagina
            $videos = [];
            self::procesarPaginaJson($json, $videos);

            // procesamos el resto si las hay
            /*while(isset($json['nextPageToken'])){
                $nextPageToken = $json['nextPageToken'];
                $nextUrl       = $url_videos . '&pageToken=' . $nextPageToken;
                $json          = json_decode(file_get_contents($nextUrl), true);
                self::procesarPaginaJson($json, $videos);
            }*/

            return $videos;
        }

        public static function procesarPaginaJson($json, &$videos){
            // procesa cada pagina de videos y almacena los datos deseados en una estructura json
            foreach($json['items'] as $video){

                if (date("Y")== date('Y', strtotime($video['snippet']['publishedAt']))) {
                    $video = array(
                        $video['snippet']['resourceId']['videoId'],
                        $video['snippet']['title'],
                        $video['snippet']['description'],
                        $video['snippet']['thumbnails']["high"],
                        $video['snippet']['publishedAt']
                    );
                    array_push($videos, $video);
                }

            }
        }
    }
