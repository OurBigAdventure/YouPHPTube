<?php
global $global, $config;
if(!isset($global['systemRootPath'])){
    require_once '../videos/configuration.php';
}
require_once '../objects/video.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $config->getLanguage(); ?>">
    <head>
        <title><?php echo $config->getWebSiteTitle(); ?> :: <?php echo __("Help to share our content"); ?></title>

        <?php
        include $global['systemRootPath'] . 'view/include/head.php';
        ?>
        <script src="<?php echo $global['webSiteRootURL']; ?>view/js/webtorrent/webtorrent.min.js" type="text/javascript"></script>
        <script>
        $(document).ready(function () {
        var client = new WebTorrent();
        <?php
        $_SESSION['type'] = "torrent";
        $videosList = Video::getAllVideos();
        foreach($videosList as $video){
          ?>
client.add('<?php echo $video['videoLink']; ?>', function (torrent) {
  var file = torrent.files.find(function (file) {
    return file.name.endsWith('.mp4');
  });
  $("#tList").append("<li id='v<?php echo $video['id']; ?>'><?php echo $video['title']; ?> (<a href='<?php echo $video['videoLink']; ?>'>Magnet</a>)<span class='ml-2' id='vseeders<?php echo $video['id']; ?>'></span><span class='ml-2' id='vdown<?php echo $video['id']; ?>'></span><span class='ml-2' id='vup<?php echo $video['id']; ?>'></span><span class='ml-2' id='vcomplete<?php echo $video['id']; ?>'></span></li>");

setInterval(onProgress, 500);
function onProgress(){
  $("#vseeders<?php echo $video['id']; ?>").html(torrent.numPeers + (torrent.numPeers === 1 ? ' peer' : ' peers'));
  $("#vdown<?php echo $video['id']; ?>").html(prettyBytes(torrent.downloadSpeed) + '/s (down)');
  $("#vup<?php echo $video['id']; ?>").html(prettyBytes(torrent.uploadSpeed) + '/s (up)');
  $("#vcomplete<?php echo $video['id']; ?>").html(prettyBytes(torrent.downloaded) + " / " + prettyBytes(torrent.length));
}
function prettyBytes(num) {
  var exponent, unit, neg = num < 0, units = ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
  if (neg) num = -num;
  if (num < 1) return (neg ? '-' : '') + num + ' B';
  exponent = Math.min(Math.floor(Math.log(num) / Math.log(1000)), units.length - 1);
  num = Number((num / Math.pow(1000, exponent)).toFixed(2));
  unit = units[exponent];
  return (neg ? '-' : '') + num + ' ' + unit;
}

  file.getBlobURL(function (err, url) {
    if (err){
      console.log(err.message);
    }
    $("#v<?php echo $video['id']; ?>").append("<a class='ml-1 btn btn-success-outline' download='<?php echo $video['title']; ?>.mp4' href='"+url+"' >Download</a>");
  });
});
          <?php
        }


        ?>
      });
        </script>
    </head>

    <body>
        <?php
        include $global['systemRootPath'] . 'view/include/navbar.php';
        ?>

        <div class="container">
            <div class="bgWhite">
                <?php
                ?>
                <h1><?php echo __("Help to share our torrent-content"); ?></h1>
                <p><?php echo __("Torrent is decentralised. This means, you can directly help to provide our videos and reduce our bandwidth."); ?></p>
                <p><?php echo __("Right now, the list down this text gets downloaded and will be seeded/shared after get complete. Also, a download-button will appear as they finished."); ?></p>
                <ul id="tList" >

                </ul>

            </div>

        </div><!--/.container-->
        <?php
        include $global['systemRootPath'] . 'view/include/footer.php';
        ?>

        <script>
            $(document).ready(function () {



            });

        </script>
    </body>
</html>
