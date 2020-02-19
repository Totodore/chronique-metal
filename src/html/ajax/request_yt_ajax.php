<?php 
    include '../system/init.php';

    // Call set_include_path() as needed to point to your client library.
    require_once ($_SERVER["DOCUMENT_ROOT"].'/src/libs/google-api-php-client/src/Google_Client.php');
    require_once ($_SERVER["DOCUMENT_ROOT"].'/src/libs/google-api-php-client/src/contrib/Google_YouTubeService.php');

    /* Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
    Google APIs Console <http://code.google.com/apis/console#access>
    Please ensure that you have enabled the YouTube Data API for your project. */
    $DEVELOPER_KEY = 'AIzaSyCLdPtkKoVLXxW-EkXPCD-LT6onpJHhCZY';

    $client = new Google_Client();    //On recuo le client Google 
    $client->setDeveloperKey($DEVELOPER_KEY); //on met la cle de securite
    $from = $_GET["from"];
    $playlist = $_GET['playlist'];
    $youtube = new Google_YoutubeService($client);    //On recup le service yt
    $response = $youtube->playlistItems->listPlaylistItems('snippet, contentDetails', array(  //on recup toutes la playlist
        "playlistId" => $playlist, //chronique metal
        "maxResults" => 50)); //max result 50
    $videos = array_slice($response['items'], $from, 4);
    if ($from + 1 > count($response['items']))
    {
        echo "no data";
        exit;
    }
?>
<?php foreach($videos as $video) { //Pour chaque videos qui marchent ?>
    <div class="disp_video">
        <h4 class="title_video"><?php echo $video['snippet']['title']; ?></h4>
        <iframe src='https://www.youtube.com/embed/<?php echo $video['contentDetails']['videoId'] ?>?wmode=transparent&amp;HD=0&amp;rel=0&amp;showinfo=0&amp;controls=1&amp;fs=1&amp;autoplay="0"' frameborder="0" allowfullscreen class="video_frame"></iframe>   
    </div>
<?php } ?>