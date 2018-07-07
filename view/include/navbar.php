<style>
    @media (max-width : 990px) {
        #mysearch {
            position: absolute;
            top: 50px;
            right: 50px;
        }
        #myNavbar {
            position: absolute;
            top: 50px;
            right: 10px;
        }
        #mysearch input {
            width: 65%;
            z-index:520 !important;
            background-color: white;
        }
        #buttonSearch {
            position:absolute;
            right: 50px;
            top: 0px;
        }
        #buttonMyNavbar {
            position:absolute;
            right: 10px;
            top: 0px;
        }

    }


</style>
<script>
    $(document).ready(function () {
        var wasMobile = true;
        $(window).resize(function () {
            if ($(window).width() > 767) {
                // Window is bigger than 767 pixels wide - show search again, if autohide by mobile.
                if (wasMobile) {
                    wasMobile = false;
                    //  $('#mysearch').addClass("in");
                    //$('#myNavbar').removeClass("show");
                }
            }
            if ($(window).width() < 767) {
                // Window is smaller 767 pixels wide - show search again, if autohide by mobile.
                if (wasMobile == false) {
                    wasMobile = true;
                    //  $('#myNavbar').removeClass("in");
                    //  $('#mysearch').removeClass("in");
                }
            }
        });
    });
</script>
<?php
global $global, $config;
if (!isset($global['systemRootPath'])) {
    require_once '../videos/configuration.php';
}
require_once $global['systemRootPath'] . 'objects/user.php';
require_once $global['systemRootPath'] . 'objects/category.php';
$_GET['parentsOnly'] = "1";
$categories = Category::getAllCategories();
if (empty($_SESSION['language'])) {
    $lang = 'us';
} else {
    $lang = $_SESSION['language'];
}

$json_file = url_get_contents("{$global['webSiteRootURL']}plugin/CustomizeAdvanced/advancedCustom.json.php");
// convert the string to a json object
$advancedCustom = json_decode($json_file);
$thisScriptFile = pathinfo($_SERVER["SCRIPT_FILENAME"]);
if (empty($advancedCustom->userMustBeLoggedIn) || User::isLogged()) {
    $updateFiles = getUpdatesFilesArray();
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top justify-content-between">
        <div class="my-nav-finder">
            <button class="float-left btn btn-light align-top" id="buttonMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><span class="fas fa-bars"></span></button>
            <a class="navbar-brand" href="<?php echo $global['webSiteRootURL']; ?>"><img src="<?php echo $global['webSiteRootURL'], $config->getLogo(); ?>" alt="<?php echo $config->getWebSiteTitle(); ?>" class="img-fluid "></a>
            <div id="sidebar1" class="dropdown" style="position: absolute; height: 100%; top:0;">
                <div id="sideBarContainer" class="dropdown-menu  dropdown-menu-left bg-light" style="" aria-labelledby="buttonMenu1" >
                    <?php
                    if (User::isLogged()) {
                        ?>
                        <li>
                            <div>
                                <a href="<?php echo $global['webSiteRootURL']; ?>logoff" class="btn btn-outline-danger btn-block" >
                                    <i class="fas fa-sign-out-alt"></i> <?php echo __("Sign Out"); ?>
                                </a>
                            </div>
                        </li>
                        <li style="min-height: 60px; margin-top: 5px;">
                            <div class="float-left" style="margin-left: 10px;">
                                <img src="<?php echo User::getPhoto(); ?>" style="max-width: 55px;"  class="img img-thumbnail img-responsive rounded-circle"/>
                            </div>
                            <div  style="margin-left: 80px;">
                                <h2 style="margin: 0; padding: 0;"><?php echo User::getName(); ?></h2>
                                <div><small><?php echo User::getMail(); ?></small></div>
                            </div>
                        </li>
                        <li>
                            <a href="<?php echo $global['webSiteRootURL']; ?>user" class=" btn btn-primary btn-block" style="border-radius: 4px 4px 0 0;">
                                <span class="fa fa-user-circle"></span>
                                <?php echo __("My Account"); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo User::getChannelLink(); ?>" class=" btn btn-danger btn-block" style="border-radius: 0;">
                                <span class="fab fa-youtube"></span>
                                <?php echo __("My Channel"); ?>
                            </a>
                        </li>


                        <?php
                        if (User::canUpload()) {
                            ?>
                            <li>
                                <a  href="<?php echo $global['webSiteRootURL']; ?>mvideos" class=" btn btn-success btn-block" style="border-radius: 0;">
                                    <i class="fas fa-video"></i>
                                    <?php echo __("My videos"); ?>
                                </a>
                            </li>
                            <?php
                        }

                        print YouPHPTubePlugin::navBarButtons();

                        if ((($config->getAuthCanViewChart() == 0) && (User::canUpload())) || (($config->getAuthCanViewChart() == 1) && (User::canViewChart()))) {
                            ?>
                            <li>
                                <a href="<?php echo $global['webSiteRootURL']; ?>charts" class="btn btn-info btn-block" style="border-radius: 0;">
                                    <span class="fas fa-tachometer-alt"></span>
                                    <?php echo __("Dashboard"); ?>
                                </a>
                            </li>

                            <?php
                        } if (User::canUpload()) {
                            ?>
                            <li>
                                <a href="<?php echo $global['webSiteRootURL']; ?>subscribes" class="btn btn-warning btn-block" style="border-radius: 0">
                                    <span class="fa fa-check"></span>
                                    <?php echo __("Subscriptions"); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $global['webSiteRootURL']; ?>comments" class="btn btn-dark btn-block" style="border-radius: 0 0 4px 4px;">
                                    <span class="fa fa-comment"></span>
                                    <?php echo __("Comments"); ?>
                                </a>
                            </li>
                            <?php
                        }
                        ?>
                        <?php
                        if (User::isAdmin()) {
                            ?>
                            <li>
                            <div class="dropdown-divider"></div>
                            <h2 class="text-danger"><?php echo __("Admin Menu"); ?></h2>
                            <a class="btn btn-sm btn-light btn-block text-left" href="<?php echo $global['webSiteRootURL']; ?>users">
                                <i class="fas fa-user"></i>
                                <?php echo __("Users"); ?>
                            </a>
                            <a class="btn btn-sm btn-light btn-block text-left" href="<?php echo $global['webSiteRootURL']; ?>usersGroups">
                                <span class="fa fa-users"></span>
                                <?php echo __("Users Groups"); ?>
                            </a>
                            <a class="btn btn-sm btn-light btn-block text-left" href="<?php echo $global['webSiteRootURL']; ?>categories">
                                <i class="fas fa-list-ul"></i>
                                <?php echo __("Categories"); ?>
                            </a>
                            <a class="btn btn-sm btn-light btn-block text-left" href="<?php echo $global['webSiteRootURL']; ?>update">
                                <i class="fas fa-sync-alt"></i>
                                <?php echo __("Update version"); ?>
                                <?php
                                if (!empty($updateFiles)) {
                                    ?><span class="badge badge-danger"><?php echo count($updateFiles); ?></span><?php
                                }
                                ?>
                            </a>
                            <a class="btn btn-sm btn-light btn-block text-left" href="<?php echo $global['webSiteRootURL']; ?>siteConfigurations">
                                <i class="fas fa-cog"></i>
                                <?php echo __("Site Configurations"); ?>
                            </a>
                            <a class="btn btn-sm btn-light btn-block text-left" href="<?php echo $global['webSiteRootURL']; ?>locale">
                                <i class="fas fa-flag"></i>
                                <?php echo __("Create more translations"); ?>
                            </a>
                            <a  class="btn btn-sm btn-light btn-block text-left" href="<?php echo $global['webSiteRootURL']; ?>plugins">
                                <span class="fa fa-plug"></span>
                                <?php echo __("Plugins"); ?>
                            </a>
                          </li>

                            <?php
                        }
                        ?>
                        <?php
                    } else {
                        ?>
                        <li>
                            <a href="<?php echo $global['webSiteRootURL']; ?>user" class="btn btn-success btn-block">
                                <i class="fas fa-sign-in-alt"></i>
                                <?php echo __("Sign In"); ?>
                            </a>
                        </li>
                        <?php
                    }
                    ?>


                    <?php
                    if (empty($advancedCustom->doNotShowLeftMenuAudioAndVideoButtons)) {
                        ?>
                        <li>
                        <div class="dropdown-divider"></div>
                                <a class="btn btn-sm btn-light btn-block text-left <?php echo empty($_SESSION['type']) ? "active" : ""; ?>" href="<?php echo $global['webSiteRootURL']; ?>?type=all">
                                    <i class="fas fa-star"></i>
                                    <?php echo __("Audios and Videos"); ?>
                                </a>
                                <a class="btn btn-sm btn-light btn-block text-left <?php echo (!empty($_SESSION['type']) && $_SESSION['type'] == 'video' && empty($_GET['catName'])) ? "active" : ""; ?>" href="<?php echo $global['webSiteRootURL']; ?>videoOnly">
                                    <i class="fas fa-video"></i>
                                    <?php echo __("Videos"); ?>
                                </a>
                                <a class="btn btn-sm btn-light btn-block text-left <?php echo (!empty($_SESSION['type']) && $_SESSION['type'] == 'audio' && empty($_GET['catName'])) ? "active" : ""; ?>" href="<?php echo $global['webSiteRootURL']; ?>audioOnly">
                                    <i class="fas fa-headphones"></i>
                                    <?php echo __("Audios"); ?>
                                </a>
                        </li>
                        <?php
                    }
                    ?>

                    <?php
                    if (empty($advancedCustom->removeBrowserChannelLinkFromMenu)) {
                        ?>
                        <!-- Channels -->
                        <div class="dropdown-divider"></div>

                        <h3 class="text-danger"><?php echo __("Channels"); ?></h3>

                        <a class="btn btn-sm btn-light btn-block text-left" href="<?php echo $global['webSiteRootURL']; ?>channels">
                            <i class="fa fa-search"></i>
                            <?php echo __("Browse Channels"); ?>
                        </a>

                        <?php
                    }
                    ?>
                    <!-- categories -->
                    <div class="dropdown-divider"></div>
                    <h3 class="text-danger"><?php echo __("Categories"); ?></h3>
                    <?php

                    function mkSub($catId) {
                        global $global;
                        unset($_GET['parentsOnly']);
                        $subcats = Category::getChildCategories($catId);
                        if (!empty($subcats)) {
                            echo "<ul style='margin-bottom: 0px; list-style-type: none;'>";
                            foreach ($subcats as $subcat) {
                                echo '<li >'
                                . '<a class="btn btn-sm btn-light btn-block text-left ' . ($subcat['clean_name'] == @$_GET['catName'] ? "active" : "") . '" href="' . $global['webSiteRootURL'] . 'cat/' . $subcat['clean_name'] . '" >'
                                . '<span class="' . (empty($subcat['iconClass']) ? "fa fa-folder" : $subcat['iconClass']) . '"></span>  ' . $subcat['name'] . '</a></li>';
                                mkSub($subcat['id']);
                            }
                            echo "</ul>";
                        }
                    }

                    foreach ($categories as $value) {

                        echo '<li >'
                        . '<a class="btn btn-sm btn-light btn-block text-left ' . ($value['clean_name'] == @$_GET['catName'] ? "active" : "") . '" href="' . $global['webSiteRootURL'] . 'cat/' . $value['clean_name'] . '" >'
                        . '<span class="' . (empty($value['iconClass']) ? "fa fa-folder" : $value['iconClass']) . '"></span>  ' . $value['name'] . '</a>';
                        mkSub($value['id']);
                        echo '</li>';
                    }
                    ?>

                    <?php
                    echo YouPHPTubePlugin::getHTMLMenuLeft();
                    ?>

                    <!-- categories END -->

                    <div class="dropdown-divider"></div>
                    <ul style="list-style: none; padding-left: 0px;">
                        <li>
                            <a class="btn btn-sm btn-light btn-block text-left" href="<?php echo $global['webSiteRootURL']; ?>help">
                                <i class="fas fa-question-circle"></i>
                                <?php echo __("Help"); ?>
                            </a>
                        </li>
                        <li>
                            <a class="btn btn-sm btn-light btn-block text-left" href="<?php echo $global['webSiteRootURL']; ?>about">
                                <i class="fas fa-info-circle"></i>
                                <?php echo __("About"); ?>
                            </a>
                        </li>
                        <li>
                            <a class="btn btn-sm btn-light btn-block text-left" href="<?php echo $global['webSiteRootURL']; ?>contact">
                                <i class="fas fa-comment"></i>
                                <?php echo __("Contact"); ?>
                            </a>
                        </li>
                        <li style="height: 150px;">
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div>
            <ul class="items-container mr-auto navbar-brand" style="">
                <li style="margin-right: 0px; " class="nav-item">
                    <div class="">
                        <button type="button" id="buttonSearch" class="d-none.d-sm-block.d-md-none navbar-toggler float-right" data-toggle="collapse" data-target="#mysearch" style="padding: 6px 12px;">
                            <span class="fa fa-search"></span>
                        </button>
                    </div>
                    <form class="form-inline collapse navbar-collapse" style="padding-left: 10px; " id="mysearch"  action="<?php echo $global['webSiteRootURL']; ?>" >

                        <div class="input-group">
                            <input class="form-control searchfield py-2 border-right-0 border" type="search" value="<?php
                            if (!empty($_GET['search'])) {
                                echo $_GET['search'];
                            }
                            ?>" name="search" placeholder="<?php echo __("Search"); ?>" />
                            <span class="input-group-append">
                                <button class="btn bg-transparent input-group-text my-2 my-sm-0 border-left-0 "   type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                </li>
                <li class="nav-item" style="margin-right: 0px; padding-left: 0px;">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggler float-right" id="buttonMyNavbar" data-toggle="collapse" data-target="#myNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse bg-light  navbar-default" style="white-space: nowrap; padding-left: 10px;" id="myNavbar">
                        <ul class="nav" style="">
                            <?php
                            if (!empty($advancedCustom->menuBarHTMLCode->value)) {
                                echo $advancedCustom->menuBarHTMLCode->value;
                            }
                            ?>

                            <?php
                            echo YouPHPTubePlugin::getHTMLMenuRight();
                            ?>
                            <?php
                            if (User::canUpload()) {
                                ?>
                                <li class="nav-item">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-light  dropdown-toggle nav-item float-left"  data-toggle="dropdown">
                                            <i class="<?php echo isset($advancedCustom->uploadButtonDropdownIcon) ? $advancedCustom->uploadButtonDropdownIcon : "fas fa-video"; ?>"></i> <?php echo!empty($advancedCustom->uploadButtonDropdownText) ? $advancedCustom->uploadButtonDropdownText : ""; ?> <span class="caret"></span>
                                        </button>
                                        <?php
                                        if ((isset($advancedCustom->onlyVerifiedEmailCanUpload) && $advancedCustom->onlyVerifiedEmailCanUpload && User::isVerified()) || (isset($advancedCustom->onlyVerifiedEmailCanUpload) && !$advancedCustom->onlyVerifiedEmailCanUpload) || !isset($advancedCustom->onlyVerifiedEmailCanUpload)
                                        ) {
                                            ?>
                                            <div class="dropdown-menu dropdown-menu-right" role="menu" style="padding: 5px;">
                                                <?php
                                                if (!empty($advancedCustom->encoderNetwork)) {
                                                    ?>
                                                        <a class="btn btn-sm btn-light btn-block text-left btn btn-light" href="<?php echo $advancedCustom->encoderNetwork, "?webSiteRootURL=", urlencode($global['webSiteRootURL']), "&user=", urlencode(User::getUserName()), "&pass=", urlencode(User::getUserPass()); ?>" target="encoder" >
                                                            <span class="fa fa-cogs"></span> <?php echo __("Encoder Network"); ?>
                                                        </a>
                                                    <?php
                                                }
                                                if (empty($advancedCustom->doNotShowEncoderButton)) {
                                                    if (!empty($config->getEncoderURL())) {
                                                        ?>
                                                            <a class="btn btn-sm btn-light btn-block text-left btn btn-light" href="<?php echo $config->getEncoderURL(), "?webSiteRootURL=", urlencode($global['webSiteRootURL']), "&user=", urlencode(User::getUserName()), "&pass=", urlencode(User::getUserPass()); ?>" target="encoder" >
                                                                <span class="fa fa-cog"></span> <?php echo __("Encode video and audio"); ?>
                                                            </a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                            <a class="btn btn-sm btn-light btn-block text-left btn btn-light" href="<?php echo $global['webSiteRootURL']; ?>siteConfigurations" ><span class="fa fa-cogs"></span> <?php echo __("Configure an Encoder URL"); ?></a>
                                                        <?php
                                                    }
                                                }
                                                if (empty($advancedCustom->doNotShowUploadMP4Button)) {
                                                    ?>
                                                        <a class="btn btn-sm btn-light btn-block text-left btn btn-light" href="<?php echo $global['webSiteRootURL']; ?>upload" >
                                                            <span class="fa fa-upload"></span> <?php echo __("Direct upload"); ?>
                                                        </a>
                                                    <?php
                                                }
                                                if (empty($advancedCustom->doNotShowImportLocalVideosButton)) {
                                                    ?>
                                                        <a class="btn btn-sm btn-light btn-block text-left btn btn-light"  href="<?php echo $global['webSiteRootURL']; ?>view/import.php" >
                                                            <span class="fas fa-hdd"></span> <?php echo __("Direct Import Local Videos"); ?>
                                                        </a>
                                                    <?php
                                                }
                                                if (empty($advancedCustom->doNotShowEmbedButton)) {
                                                    ?>
                                                        <a class="btn btn-sm btn-light btn-block text-left btn btn-light" href="<?php echo $global['webSiteRootURL']; ?>mvideos?link=1" >
                                                            <span class="fa fa-link"></span> <?php echo __("Embed a video link"); ?>
                                                        </a>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu" style="">
                                                <li>
                                                    <a  href="" >
                                                        <span class="fa fa-exclamation"></span> <?php echo __("Only verified users can upload"); ?>
                                                    </a>
                                                </li>
                                            </ul>

                                            <?php
                                        }
                                        ?>
                                    </div>

                                </li>
                                <?php
                            }
                            ?>
                            <li class="nav-item">
                                <?php
                                $flags = getEnabledLangs();
                                $objFlag = new stdClass();
                                foreach ($flags as $key => $value) {
                                    //$value = strtoupper($value);
                                    $objFlag->$value = $value;
                                }
                                if ($lang == 'en') {
                                    $lang = 'us';
                                }
                                ?>
                                <style>
                                    #navBarFlag .dropdown-menu {
                                        min-width: 20px;
                                    }
                                </style>
                                <div id="navBarFlag" data-input-name="country" data-selected-country="<?php echo $lang; ?>"></div>
                                <script>
                                    $(function () {
                                        $("#navBarFlag").flagStrap({
                                            countries: <?php echo json_encode($objFlag); ?>,
                                            inputName: 'country',
                                            buttonType: "btn-light nav-item",
                                            onSelect: function (value, element) {
                                                window.location.href = "<?php echo $global['webSiteRootURL']; ?>?lang=" + value;
                                            },
                                            placeholder: {
                                                value: "",
                                                text: ""
                                            }
                                        });
                                    });
                                </script>
                            </li>
                             <?php
                        if (empty($advancedCustom->signInOnRight)) {
                            if (User::isLogged()) {
                                ?>
                                <li>
                                    <a class="btn navbar-btn btn-light"  href="<?php echo $global['webSiteRootURL']; ?>logoff">
                                        <i class="fas fa-sign-out-alt"></i> <?php echo __("Sign Out"); ?>
                                    </a>
                                </li>
                                <?php
                            } else {
                                ?>
                                <li>
                                    <a class="btn navbar-btn btn-light" href="<?php echo $global['webSiteRootURL']; ?>user" >
                                        <i class="fas fa-sign-in-alt"></i> <?php echo __("Sign In"); ?>
                                    </a>
                                </li>
                                <?php
                            }
                        }
                        ?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <?php
    if (!empty($advancedCustom->underMenuBarHTMLCode->value)) {
        echo $advancedCustom->underMenuBarHTMLCode->value;
    }
} else if ($thisScriptFile["basename"] !== 'user.php') {
    header("Location: {$global['webSiteRootURL']}user");
}
?>
