<?php 
    include '../system/init.php';
    $currentPage = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if ($_SERVER['REQUEST_METHOD'] == "GET" && strcmp(basename($currentPage), basename(__FILE__)) == 0)
    {
        http_response_code(404);
        header("Location: /");
        die(); /* remove this if you want to execute the rest of
                the code inside the file before redirecting. */
    }
    
    // Call set_include_path() as needed to point to your client library.
    require_once ($_SERVER["DOCUMENT_ROOT"].'/src/libs/google-api-php-client/src/Google_Client.php');
    require_once ($_SERVER["DOCUMENT_ROOT"].'/src/libs/google-api-php-client/src/contrib/Google_YouTubeService.php');

    /* Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
    Google APIs Console <http://code.google.com/apis/console#access>
    Please ensure that you have enabled the YouTube Data API for your project. */
    $DEVELOPER_KEY = 'AIzaSyCLdPtkKoVLXxW-EkXPCD-LT6onpJHhCZY';

    $client = new Google_Client();    //On recuo le client Google 
    $client->setDeveloperKey($DEVELOPER_KEY); //on met la cle de securite
    $name = $_GET["name"];
    $artist = $_GET['artist'];
    $youtube = new Google_YoutubeService($client);    //On recup le service yt
    $response = $youtube->search->listSearch('snippet, id', array('q' => $artist."-".$name, 'maxResults' => 1, 'type' => 'video'));
    $video = $response['items'][0];
?>
<h4 class="title_video"><?php echo $video['snippet']['title']; ?><i class="material-icons openModal" onclick="closeModal()">close</i></h4>
<iframe src='http://www.youtube.com/embed/<?php echo $video['id']['videoId'] ?>?wmode=transparent&amp;HD=0&amp;rel=0&amp;showinfo=0&amp;controls=1&amp;fs=1&amp;autoplay="0"' frameborder="0" allowfullscreen class="video_frame"></iframe>
