<link href="<?php echo $global['webSiteRootURL']; ?>view/css/font-awesome-animation.min.css" rel="stylesheet" type="text/css"/>
<style>
    .liveVideo{
        position: relative;
    }
    .liveVideo .liveNow{
        position: absolute;
        bottom: 5px;
        right: 5px;
        background-color: rgba(255,0,0,0.7);
    }
</style>
<?php
if (User::canStream()) {
    ?>
    <li class="nav-item">
        <a href="<?php echo $global['webSiteRootURL']; ?>plugin/Live"  class="btn btn-danger" data-toggle="tooltip" title="<?php echo __("Broadcast a Live Streaming"); ?>" data-placement="bottom" >
            <span class="fa fa-circle"></span> <?php echo $buttonTitle; ?>
        </a>
    </li>
    <?php
}
?>

<li class="nav-item dropdown">
    <a class="dropdown-toggle btn btn-light  " href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="fa-layers fa-fw" style="">
            <i class="fa fa-bell"></i>
            <span class="fa-layers-counter onlineApplications fa-2x" style="background:Tomato; ">0</span>
        </span>
    </a>

    <ul class="dropdown-menu dropdown-menu-right notify-drop" id="availableLiveStream"></ul>
</li>
<li class="d-none liveModel dropdown-item"  style="margin-right: 0;">
    <a href="<?php echo $global['webSiteRootURL']; ?>plugin/Live/" class='liveLink btn btn-light'>
        <div class="float-left">
            <img src="" class="img rounded-circle img-fluid" style="max-width: 38px;">
        </div>
        <div style="margin-left: 40px;">
            <i class="fas fa-video"></i> <strong class="liveTitle"><?php echo __("Title"); ?></strong> <br>
            <span class="badge badge-success liveUser"><?php echo __("User"); ?></span> <span class="badge badge-danger liveNow faa-flash faa-slow animated d-none"><?php echo __("LIVE NOW"); ?></span>
        </div>
    </a>
</li>
<div class="col-lg-12 col-sm-12 col-12 bottom-border d-none extraVideosModel liveVideo" itemscope itemtype="http://schema.org/VideoObject">
    <a href="" class="h6 videoLink">
        <div class="col-lg-5 col-sm-5 col-5 nopadding thumbsImage" style="min-height: 70px; position:relative;" >
            <img src="" class="thumbsJPG img-fluid" height="130" />
            <img src="" style="position: absolute; top: 0; display: none;" class="thumbsGIF img-fluid" height="130" />
            <span class="badge badge-danger liveNow faa-flash faa-slow animated"><?php echo __("LIVE NOW"); ?></span>
        </div>
        <div class="col-lg-7 col-sm-7 col-7 videosDetails">
            <div class="text-uppercase row"><strong itemprop="name" class="title liveTitle"><?php echo __("Title"); ?></strong></div>
            <div class="details row" itemprop="description">
                <div class="float-left">
                    <img src="" class="photoImg img rounded-circle img-fluid" style="max-width: 20px;">
                </div>
                <div style="margin-left: 25px;">
                    <div class="liveUser"><?php echo __("User"); ?></div>
                </div>
            </div>
            <?php
            require_once $global['systemRootPath'] . 'plugin/YouPHPTubePlugin.php';
            // the live users plugin
            if (YouPHPTubePlugin::isEnabled("cf145581-7d5e-4bb6-8c12-48fc37c0630d")) {
                ?>
                <span class="badge badge-primary"  data-toggle="tooltip" title="<?php echo __("Watching Now"); ?>" data-placement="bottom" ><i class="fa fa-user"></i> <b class="liveUsersOnline">0</b></span>
                <span class="badge badge-default"  data-toggle="tooltip" title="<?php echo __("Total Views"); ?>" data-placement="bottom" ><i class="fa fa-eye"></i> <b class="liveUsersViews">0</b></span>
                <?php
            }
            ?>
        </div>
    </a>
</div>
<script>
    var loadedExtraVideos = [];
    /* Use this funtion to display live videos dynamic on pages*/
    function afterExtraVideos($liveLi) {
        return $liveLi
    }

    function createLiveItem(href, title, name, photo, offline, online, views, key) {
        var $liveLi = $('.liveModel').clone();
        if (offline) {
            $liveLi.find('.fa-video').removeClass("fa-video").addClass("fa-ban");
            $liveLi.find('.liveUser').removeClass("label-success").addClass("label-danger");
            $liveLi.find('.badge').text("offline");
        }
        $liveLi.removeClass("d-none").removeClass("liveModel");
        $liveLi.find('a').attr("href", href);
        $liveLi.find('.liveTitle').text(title);
        $liveLi.find('.liveUser').text(name);
        $liveLi.find('.img').attr("src", photo);
        $('#availableLiveStream').append($liveLi);

        if (href != "#") {
            $liveLi.find('.liveNow').removeClass("d-none");
        }

        $('.liveUsersOnline_' + key).text(online);
        $('.liveUsersViews_' + key).text(views);
    }

    function createExtraVideos(href, title, name, photo, user, online, views, key, disableGif) {
        var id = 'extraVideo' + user;
        id = id.replace(/\W/g, '');
        if ($(".extraVideos").length && $("#" + id).length == 0) {
            var $liveLi = $('.extraVideosModel').clone();
            $liveLi.removeClass("d-none").removeClass("extraVideosModel");
            $liveLi.css({'display': 'none'})
            $liveLi.attr('id', id);
            $liveLi.find('.videoLink').attr("href", href);
            $liveLi.find('.liveTitle').text(title);
            $liveLi.find('.liveUser').text(name);
            $liveLi.find('.photoImg').attr("src", photo);
            $liveLi.find('.liveUsersOnline').text(online);
            $liveLi.find('.liveUsersViews').text(views);
            $liveLi.find('.liveUsersOnline').addClass("liveUsersOnline_" + key);
            $liveLi.find('.liveUsersViews').addClass("liveUsersViews_" + key);
            $liveLi.find('.thumbsJPG').attr("src", "<?php echo $global['webSiteRootURL']; ?>plugin/Live/getImage.php?u=" + user + "&format=jpg");
            if (!disableGif) {
                $liveLi.find('.thumbsGIF').attr("src", "<?php echo $global['webSiteRootURL']; ?>plugin/Live/getImage.php?u=" + user + "&format=gif");
            } else {
                $liveLi.find('.thumbsGIF').remove();
            }
            $liveLi = afterExtraVideos($liveLi);
            $('.extraVideos').append($liveLi);
            $liveLi.slideDown();
        }
    }

    function getStatsMenu(recurrentCall) {
        $.ajax({
            url: '<?php echo $global['webSiteRootURL']; ?>plugin/Live/stats.json.php?Menu<?php echo (!empty($_GET['videoName']) ? "&requestComesFromVideoPage=1" : "") ?>',
                        success: function (response) {
                            if (typeof response.applications !== 'undefined') {
                                $('.onlineApplications').text(response.applications.length);
                                $('#availableLiveStream').empty();
                                if (response.applications.length) {
                                    disableGif = response.disableGif;
                                    for (i = 0; i < response.applications.length; i++) {
                                        if (typeof response.applications[i].html != 'undefined') {
                                            $('#availableLiveStream').append(response.applications[i].html);
                                            if (typeof response.applications[i].htmlExtra != 'undefined') {
                                                var id = $(response.applications[i].htmlExtra).attr('id');
                                                if (loadedExtraVideos.indexOf(id) == -1) {
                                                    loadedExtraVideos.push(id)
                                                    $('.extraVideos').append(response.applications[i].htmlExtra);
                                                }
                                            }
                                            $('#liveVideos').slideDown();
                                        } else {
                                            href = "<?php echo $global['webSiteRootURL']; ?>plugin/Live/?c=" + response.applications[i].channelName;
                                            title = response.applications[i].title;
                                            name = response.applications[i].name;
                                            user = response.applications[i].user;
                                            photo = response.applications[i].photo;
                                            online = response.applications[i].users.online;
                                            views = response.applications[i].users.views;
                                            key = response.applications[i].key;
                                            createLiveItem(href, title, name, photo, false, online, views, key);
                                            createExtraVideos(href, title, name, photo, user, online, views, key, disableGif);
                                        }
                                    }
                                    mouseEffect();
                                } else {
                                    createLiveItem("#", "<?php echo __("There is no streaming now"); ?>", "", "", true);
                                }
                            }
                            if (recurrentCall) {
                                setTimeout(function () {
                                    getStatsMenu(true);
                                }, 10000);
                            }
                        }
                    });
                }

                $(document).ready(function () {
                    getStatsMenu(true);
                });
</script>
