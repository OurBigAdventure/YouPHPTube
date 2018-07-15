<script src="<?php echo $global['webSiteRootURL']; ?>view/js/webtorrent/webtorrent.min.js" type="text/javascript"></script>
<?php
$playNowVideo = $video;
$transformation = "{rotate:" . $video['rotation'] . ", zoom: " . $video['zoom'] . "}";

if ($video['rotation'] === "90" || $video['rotation'] === "270") {
    $aspectRatio = "9:16";
    $vjsClass = "vjs-9-16";
    $embedResponsiveClass = "embed-responsive-9by16";
} else {
    $aspectRatio = "16:9";
    $vjsClass = "vjs-16-9";
    $embedResponsiveClass = "embed-responsive-16by9";
}
?>
<div class="row main-video" id="mvideo">
    <div class="col-sm-2 col-md-2 firstC"></div>
    <div class="col-sm-8 col-md-8 secC">
        <div id="videoContainer">
            <div id="floatButtons" style="display: none;">
                <p class="btn btn-outline btn-xs move">
                    <i class="fas fa-expand-arrows-alt"></i>
                </p>
                <button type="button" class="btn btn-outline btn-xs"
                        onclick="closeFloatVideo();floatClosed = 1;">
                    <i class="far fa-window-close"></i>
                </button>
            </div>
            <div id="main-video" class="embed-responsive <?php echo $embedResponsiveClass; ?>">
                <video
                <?php if ($config->getAutoplay() && false) { // disable it for now ?>
                        autoplay="true"
                        muted="muted"
                    <?php } ?>
                    preload="auto"
                    poster="<?php echo $poster; ?>" controls class="embed-responsive-item video-js vjs-default-skin <?php echo $vjsClass; ?> vjs-big-play-centered" id="mainVideo" data-setup='{ "aspectRatio": "<?php echo $aspectRatio; ?>" }'>
                    <!-- This source-line is needed to get webtorrent loading a video. Therefore it's a workaround. -->
                    <source src="weirdlyneeded.mp4" type="video/mp4" ></source>
                    <p><?php echo __("If you can't view this video, your browser does not support HTML5 videos"); ?></p>
                    <p class="vjs-no-js"><?php echo __("To view this video please enable JavaScript, and consider upgrading to a web browser that"); ?>
                        <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>
                </video>
                <?php
                require_once $global['systemRootPath'] . 'plugin/YouPHPTubePlugin.php';
                // the live users plugin
                if (YouPHPTubePlugin::isEnabled("0e225f8e-15e2-43d4-8ff7-0cb07c2a2b3b")) {
                    require_once $global['systemRootPath'] . 'plugin/VideoLogoOverlay/VideoLogoOverlay.php';
                    $style = VideoLogoOverlay::getStyle();
                    $url = VideoLogoOverlay::getLink();
                    ?>
                    <div style="<?php echo $style; ?>">
                        <a href="<?php echo $url; ?>"> <img src="<?php echo $global['webSiteRootURL']; ?>videos/logoOverlay.png" class="img-responsive col-lg-12 col-md-8 col-sm-7 col-xs-6"></a>
                    </div>
                <?php } ?>

            </div>
        </div>
        <?php if ($config->getAllow_download()) { ?>
                <a class="btn btn-xs btn-default pull-right d-none" id="downloadButton" role="button" href="<?php echo $video['videoLink']; ?>" download="<?php echo $playNowVideo['title'] . ".mp4"; ?>" >
                    <i class="fa fa-download"></i>
                    <?php echo __("Download video"); ?>
                </a>
        <?php } ?>
    </div>
    <div class="col-sm-2 col-md-2"></div>

</div>



<div class="modal fade" style="width: 60%;" id="torrentDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo __("Torrent-connection-details"); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<div id="torrentInfo" class="ml-2">
  <table class="table table-fluid col-10 text-secondary">
    <tbody>
    <tr class=" "> <td id="torrentSeeders"></td><td id="torrentDownloadSpeed" > </td><td id="torrentUploadSpeed"></td><td id="torrentDownloaded"></td></tr>
    <tr class=""><td><a href="<?php echo $global['webSiteRootURL']; ?>view/seeder.php" target="torrentWindow"><?php echo __("Support us and seed all torrent-videos with your pc"); ?></a> </td><td ><a href="<?php echo $video['videoLink']; ?>"  ><?php echo __("Magnet-link"); ?></a></td><td class="" id="torrentDL"></td></tr>
  </tbody>
  </table>
</div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo __("Close"); ?></button>
</div>
</div>
</div>
</div>
<!--/row-->
<script>
<?php $_GET['isMediaPlaySite'] = $playNowVideo['id']; ?>

    var mediaId = <?php echo $playNowVideo['id']; ?>;
    var client = new WebTorrent();

    var torrentId = '<?php echo $playNowVideo['videoLink']; ?>';
    var player;

    $(document).ready(function () {
        client.add(torrentId, function (torrent) {
        // Torrents can contain many files. Let's use the .mp4 file
        var file = torrent.files.find(function (file) {
          return file.name.endsWith('.mp4');
        });

        // Display the file by adding it to the DOM. Supports video, audio, image, etc. files
        file.renderTo('#mainVideo_html5_api');
        // Trigger statistics refresh
        torrent.on('done', onDone);
        setInterval(onProgress, 500);
        onProgress();
        file.getBlobURL(function (err, url) {
          if (err){
            console.log(err.message);
          }
          $("#downloadButton").attr("href",url);
          $("#downloadButton").removeClass("d-none");
        });
        $("#torrentDL").html("<a href='"+torrent.torrentFileBlobURL+"' download='<?php echo $playNowVideo['title']; ?>.torrent'><?php echo __("Torrent-file"); ?></a>");
        function onProgress () {
          // Peers
          $("#torrentSeeders").html(torrent.numPeers + (torrent.numPeers === 1 ? ' peer' : ' peers'));
          // Progress
          var percent = Math.round(torrent.progress * 100 * 100) / 100;
          $("#torrentDownloaded").html(prettyBytes(torrent.downloaded) + " / " + prettyBytes(torrent.length) + " ("+percent+"%)");

          // Speed rates
          $("#torrentDownloadSpeed").html(prettyBytes(torrent.downloadSpeed) + '/s (down)');
          $("#torrentUploadSpeed").html(prettyBytes(torrent.uploadSpeed) + '/s (up)');
        }
        function onDone () {
          onProgress();
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
      });
<?php
if (!$config->getAllow_download()) {
    ?>
            // Prevent HTML5 video from being downloaded (right-click saved)?
            $('#mainVideo').bind('contextmenu', function () {
                return false;
            });
<?php } ?>
        player = videojs('mainVideo');
        player.zoomrotate(<?php echo $transformation; ?>);
        player.on('play', function () {
            addView(<?php echo $playNowVideo['id']; ?>);
        });
        player.ready(function () {



<?php if ($config->getAutoplay()) {
    ?>
                setTimeout(function () {
                    if (typeof player === 'undefined') {
                        player = videojs('mainVideo');
                    }
                    try {
                        player.play();
                    } catch (e) {
                        setTimeout(function () {
                            player.play();
                        }, 1000);
                    }
                }, 150);
<?php } else {
    ?>
                if (Cookies.get('autoplay') && Cookies.get('autoplay') !== 'false') {
                    setTimeout(function () {
                        if (typeof player === 'undefined') {
                            player = videojs('mainVideo');
                        }
                        try {
                            player.play();
                        } catch (e) {
                            setTimeout(function () {
                                player.play();
                            }, 1000);
                        }
                    }, 150);
                }
<?php }
?>
            this.on('ended', function () {
                console.log("Finish Video");
<?php
// if autoplay play next video
if (!empty($autoPlayVideo)) {
    ?>
                    if (Cookies.get('autoplay') && Cookies.get('autoplay') !== 'false') {
                        document.location = '<?php echo $autoPlayVideo['url']; ?>';
                    }
<?php } ?>

            });
        });
        player.persistvolume({
            namespace: "YouPHPTube"
        });

        // in case the video is muted
        setTimeout(function () {
            if (player.muted()) {
                swal({
                    title: "<?php echo __("Your Media is Muted"); ?>",
                    text: "<?php echo __("Would you like to unmute it?"); ?>",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "<?php echo __("Yes, unmute it!"); ?>",
                    closeOnConfirm: true
                },
                        function () {
                            player.muted(false);
                        });
            }
        }, 500);

    });
</script>
<?php
// finish doing torrent-specific stuff..
$playNowVideo['type']="video";
$video['type']="video";
 ?>
