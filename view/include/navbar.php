<style>
@media (max-width : 990px) {
#mysearch {
  position: absolute;
  top: 50px;
  left: 25%;
  right: 25%;
}
#myNavbar {
  position: absolute;
  top: 50px;
  right: 10px;
}
#mysearch input {
  width: 80%;
}
}
</style>
<script>
$( document ).ready(function() {
    var wasMobile = true;
    $(window).resize(function() {
        if ($(window).width() > 767) {
          // Window is bigger than 767 pixels wide - show search again, if autohide by mobile.
          if(wasMobile){
            wasMobile = false;
        //  $('#mysearch').addClass("in");
         //$('#myNavbar').removeClass("show");
        }
        }
        if ($(window).width() < 767) {
          // Window is smaller 767 pixels wide - show search again, if autohide by mobile.
          if(wasMobile==false){
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
if(!isset($global['systemRootPath'])){
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
      <div>
      <button class="btn-light btn" id="buttonMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><span class="navbar-toggler-icon"></span></button>

        <div id="sidebar1" class="dropdown" style="position: absolute; height: 100%;">
                <ul class="dropdown-menu  dropdown-menu-left" aria-labelledby="buttonMenu1" style="overflow-y: auto; max-height: 400px;">
                    <?php
                    if (User::isLogged()) {
                        ?>
                        <li class="dropdown-item">
                                <a href="<?php echo $global['webSiteRootURL']; ?>logoff" class="btn btn-default btn-block" >
                                    <span class="glyphicon glyphicon-log-out"></span>
        <?php echo __("Logoff"); ?>
                                </a>
                        </li>
                        <li class="dropdown-item" style="min-height: 60px;">
                            <div class="text-center" style="margin-left: 10px;">
                                <img src="<?php echo User::getPhoto(); ?>" style="max-width: 55px;"  class="img align-middle img-fluid img-thumbnail"/>
                            </div>
                            <div  style="margin-left: 80px;">
                                <h2><?php echo User::getName(); ?></h2>
                                <div><small><?php echo User::getMail(); ?></small></div>

                            </div>
                        </li>
                        <li class="dropdown-item">

                            <div>
                                <a href="<?php echo $global['webSiteRootURL']; ?>user" class="btn btn-primary btn-block" style="border-radius: 4px 4px 0 0;">
                                    <span class="fa fa-user-circle"></span>
        <?php echo __("My Account"); ?>
                                </a>

                            </div>
                        </li>

                        <li class="dropdown-item">

                            <div>
                                <a href="<?php echo User::getChannelLink(); ?>" class="btn btn-danger btn-block" style="border-radius: 0;">
                                    <span class="fab fa-youtube"></span>
        <?php echo __("My Channel"); ?>
                                </a>

                            </div>
                        </li>

                        <?php
                        if (User::canUpload()) {
                            ?>
                            <li class="dropdown-item">
                                <div>
                                    <a href="<?php echo $global['webSiteRootURL']; ?>mvideos" class="btn btn-success btn-block" style="border-radius: 0;">
                                        <span class="glyphicon glyphicon-film"></span>
                                        <span class="glyphicon glyphicon-headphones"></span>
            <?php echo __("My videos"); ?>
                                    </a>
                                </div>
                            </li>
                            <?php
                          }
                            if ((($config->getAuthCanViewChart()==0)&&(User::canUpload()))||(($config->getAuthCanViewChart()==1)&&(User::canViewChart()))) {
                                ?>
                            <li class="dropdown-item" >
                                <div>
                                    <a href="<?php echo $global['webSiteRootURL']; ?>charts" class="btn btn-info btn-block" style="border-radius: 0;">
                                        <span class="fas fa-tachometer-alt"></span>
            <?php echo __("Dashboard"); ?>
                                    </a>
                                </div>
                            </li>
                            <?php
                          } if (User::canUpload()) {
                                ?>
                            <li class="dropdown-item">
                                <div>
                                    <a href="<?php echo $global['webSiteRootURL']; ?>subscribes" class="btn btn-warning btn-block" style="border-radius: 0">
                                        <span class="fa fa-check"></span>
            <?php echo __("Subscriptions"); ?>
                                    </a>
                                </div>
                            </li>
                            <li class="dropdown-item">
                                <div>
                                    <a href="<?php echo $global['webSiteRootURL']; ?>comments" class="btn btn-default btn-block" style="border-radius: 0 0 4px 4px;">
                                        <span class="fa fa-comment"></span>
            <?php echo __("Comments"); ?>
                                    </a>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                        <?php
                        if (User::isAdmin()) {
                            ?>

                            <li class="dropdown-item">
                                <hr>
                                <h2 class="text-danger"><?php echo __("Admin Menu"); ?></h2>
                                <ul  class="" style="margin-bottom: 10px; padding-left:0px;">
                                    <li class="dropdown-item">
                                        <a href="<?php echo $global['webSiteRootURL']; ?>users">
                                            <span class="glyphicon glyphicon-user"></span>
            <?php echo __("Users"); ?>
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="<?php echo $global['webSiteRootURL']; ?>usersGroups">
                                            <span class="fa fa-users"></span>
            <?php echo __("Users Groups"); ?>
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="<?php echo $global['webSiteRootURL']; ?>categories">
                                            <span class="glyphicon glyphicon-list"></span>
            <?php echo __("Categories"); ?>
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="<?php echo $global['webSiteRootURL']; ?>update">
                                            <span class="glyphicon glyphicon-refresh"></span>
                                            <?php echo __("Update version"); ?>
                                            <?php
                                            if (!empty($updateFiles)) {
                                                ?><span class="label label-danger"><?php echo count($updateFiles); ?></span><?php
                            }
                            ?>
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="<?php echo $global['webSiteRootURL']; ?>siteConfigurations">
                                            <span class="glyphicon glyphicon-cog"></span>
            <?php echo __("Site Configurations"); ?>
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="<?php echo $global['webSiteRootURL']; ?>locale">
                                            <span class="glyphicon glyphicon-flag"></span>
            <?php echo __("Create more translations"); ?>
                                        </a>
                                    </li>
                                    <li class="dropdown-item">
                                        <a href="<?php echo $global['webSiteRootURL']; ?>plugins">
                                            <span class="fa fa-plug"></span>
            <?php echo __("Plugins"); ?>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <?php
                        }
                        ?>
                        <?php
                    } else {
                        ?>
                        <li>
                            <div>
                                <a href="<?php echo $global['webSiteRootURL']; ?>user" class="btn btn-success btn-block">
                                    <span class="glyphicon glyphicon-log-in"></span>
        <?php echo __("Login"); ?>
                                </a>
                            </div>
                        </li>
                        <?php
                    }
                    ?>


                    <?php
                    if (empty($advancedCustom->doNotShowLeftMenuAudioAndVideoButtons)) {
                        ?>
                        <li>
                            <hr>
                        </li>
                        <li class="nav-item <?php echo empty($_SESSION['type']) ? "active" : ""; ?>">
                            <a class="nav-link " href="<?php echo $global['webSiteRootURL']; ?>?type=all">
                                <span class="glyphicon glyphicon-star"></span>
        <?php echo __("Audios and Videos"); ?>
                            </a>
                        </li>
                        <li class="nav-item <?php echo (!empty($_SESSION['type']) && $_SESSION['type'] == 'video' && empty($_GET['catName'])) ? "active" : ""; ?>">
                            <a class="nav-link " href="<?php echo $global['webSiteRootURL']; ?>videoOnly">
                                <span class="glyphicon glyphicon-facetime-video"></span>
        <?php echo __("Videos"); ?>
                            </a>
                        </li>
                        <li class="nav-item <?php echo (!empty($_SESSION['type']) && $_SESSION['type'] == 'audio' && empty($_GET['catName'])) ? "active" : ""; ?>">
                            <a class="nav-link" href="<?php echo $global['webSiteRootURL']; ?>audioOnly">
                                <span class="glyphicon glyphicon-headphones"></span>
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
                        <li class="dropdown-item">
                            <hr>
                            <h3 class="text-danger"><?php echo __("Channels"); ?></h3>
                        </li>
                        <li class="dropdown-item">
                            <a href="<?php echo $global['webSiteRootURL']; ?>channels">
                                <i class="fa fa-search"></i>
        <?php echo __("Browse Channels"); ?>
                            </a>
                        </li>

                        <?php
                    }
                    ?>
                    <!-- categories -->
                    <li class="dropdown-item">
                        <hr>
                        <h3 class="text-danger"><?php echo __("Categories"); ?></h3>
                    </li>
                    <?php

                    function mkSub($catId) {
                        global $global;
                        unset($_GET['parentsOnly']);
                        $subcats = Category::getChildCategories($catId);
                        if (!empty($subcats)) {
                            echo "<ul style='margin-bottom: 0px; list-style-type: none;'>";
                            foreach ($subcats as $subcat) {
                                echo '<li class="dropdown-item ' . ($subcat['clean_name'] == @$_GET['catName'] ? "active" : "") . '">'
                                . '<a href="' . $global['webSiteRootURL'] . 'cat/' . $subcat['clean_name'] . '" >'
                                . '<span class="' . (empty($subcat['iconClass']) ? "fa fa-folder" : $subcat['iconClass']) . '"></span>  ' . $subcat['name'] . '</a></li>';
                                mkSub($subcat['id']);
                            }
                            echo "</ul>";
                        }
                    }

                    foreach ($categories as $value) {

                        echo '<li class="dropdown-item ' . ($value['clean_name'] == @$_GET['catName'] ? "active" : "") . '">'
                        . '<a href="' . $global['webSiteRootURL'] . 'cat/' . $value['clean_name'] . '" >'
                        . '<span class="' . (empty($value['iconClass']) ? "fa fa-folder" : $value['iconClass']) . '"></span>  ' . $value['name'] . '</a>';
                        mkSub($value['id']);
                        echo '</li>';
                    }
                    ?>

                    <?php
                    echo YouPHPTubePlugin::getHTMLMenuLeft();
                    ?>

                    <!-- categories END -->

                    <li>
                        <hr>
                    </li>
                    <li class="dropdown-item">
                        <a href="<?php echo $global['webSiteRootURL']; ?>help">
                            <span class="glyphicon glyphicon-question-sign"></span>
    <?php echo __("Help"); ?>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="<?php echo $global['webSiteRootURL']; ?>about">
                            <span class="glyphicon glyphicon-info-sign"></span>
    <?php echo __("About"); ?>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="<?php echo $global['webSiteRootURL']; ?>contact">
                            <span class="glyphicon glyphicon-comment"></span>
    <?php echo __("Contact"); ?>
                        </a>
                    </li>
                </ul>
        </div>
        <a class="navbar-brand" href="<?php echo $global['webSiteRootURL']; ?>"><img src="<?php echo $global['webSiteRootURL'], $config->getLogo(); ?>" alt="<?php echo $config->getWebSiteTitle(); ?>" class="img-responsive "></a>
      </div>

        <div>
          <ul class="items-container mr-auto navbar-brand" style="">
              <li style="margin-right: 0px; " class="nav-item">
                  <div class="">
                      <button type="button" id="buttonSearch" class="visible-xs navbar-toggler" data-toggle="collapse" data-target="#mysearch" style="padding: 6px 12px;">
                          <span class="fa fa-search"></span>
                      </button>
                  </div>
            <form class="form-inline collapse navbar-collapse bg-light text-center justify-content-between" id="mysearch"  action="<?php echo $global['webSiteRootURL']; ?>" >
                <input class="form-control mr-sm-2" type="search" value="<?php if (!empty($_GET['search'])) {echo $_GET['search'];} ?>" name="search" placeholder="<?php echo __("Search"); ?>" />
                <button class="btn btn-success my-2 my-sm-0"   type="submit"><span class="fa fa-search"></span></button>
            </form>
        </li>
              <li style="margin-right: 0px; padding-left: 0px;">
                  <div class="navbar-header">
                      <button type="button" class="navbar-toggler" id="buttonMyNavbar" data-toggle="collapse" data-target="#myNavbar">
                          <span class="navbar-toggler-icon"></span>
                      </button>
                  </div>
                  <div class="collapse navbar-collapse bg-light text-center" style="padding-left: 10px;padding-bottom: 10px;" id="myNavbar">
                      <ul class="navbar-default" style="padding-left: 0;">
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
                              <li>
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-default  dropdown-toggle navbar-btn pull-left"  data-toggle="dropdown">
                                          <i class="<?php echo isset($advancedCustom->uploadButtonDropdownIcon) ? $advancedCustom->uploadButtonDropdownIcon : "fas fa-video"; ?>"></i> <?php echo!empty($advancedCustom->uploadButtonDropdownText) ? $advancedCustom->uploadButtonDropdownText : ""; ?> <span class="caret"></span>
                                      </button>
                                      <?php
                                      if( (isset($advancedCustom->onlyVerifiedEmailCanUpload) && $advancedCustom->onlyVerifiedEmailCanUpload && User::isVerified()) || (isset($advancedCustom->onlyVerifiedEmailCanUpload) && !$advancedCustom->onlyVerifiedEmailCanUpload)  || !isset($advancedCustom->onlyVerifiedEmailCanUpload)
                                      ){
                                      ?>
                                          <ul class="dropdown-menu dropdown-menu-right" role="menu" style="">
                                              <?php
                                              if (!empty($advancedCustom->encoderNetwork)) {
                                                  ?>
                                                  <li>
                                                      <a href="<?php echo $advancedCustom->encoderNetwork, "?webSiteRootURL=", urlencode($global['webSiteRootURL']), "&user=", urlencode(User::getUserName()), "&pass=", urlencode(User::getUserPass()); ?>" target="encoder" >
                                                          <span class="fa fa-cogs"></span> <?php echo __("Encoder Network"); ?>
                                                      </a>
                                                  </li>
                                                  <?php
                                              }
                                              if (empty($advancedCustom->doNotShowEncoderButton)) {
                                                  if (!empty($config->getEncoderURL())) {
                                                      ?>
                                                      <li>
                                                          <a href="<?php echo $config->getEncoderURL(), "?webSiteRootURL=", urlencode($global['webSiteRootURL']), "&user=", urlencode(User::getUserName()), "&pass=", urlencode(User::getUserPass()); ?>" target="encoder" >
                                                              <span class="fa fa-cog"></span> <?php echo __("Encode video and audio"); ?>
                                                          </a>
                                                      </li>
                                                      <?php
                                                  } else {
                                                      ?>
                                                      <li>
                                                          <a href="<?php echo $global['webSiteRootURL']; ?>siteConfigurations" ><span class="fa fa-cogs"></span> <?php echo __("Configure an Encoder URL"); ?></a>
                                                      </li>
                                                      <?php
                                                  }
                                              }
                                              if (empty($advancedCustom->doNotShowUploadMP4Button)) {
                                                  ?>
                                                  <li>
                                                      <a  href="<?php echo $global['webSiteRootURL']; ?>upload" >
                                                          <span class="fa fa-upload"></span> <?php echo __("Direct upload"); ?>
                                                      </a>
                                                  </li>
                                                  <?php
                                              }
                                              if (empty($advancedCustom->doNotShowImportLocalVideosButton)) {
                                                  ?>
                                                  <li>
                                                      <a  href="<?php echo $global['webSiteRootURL']; ?>view/import.php" >
                                                          <span class="fas fa-hdd"></span> <?php echo __("Direct Import Local Videos"); ?>
                                                      </a>
                                                  </li>
                                                  <?php
                                              }
                                              if (empty($advancedCustom->doNotShowEmbedButton)) {
                                                  ?>
                                                  <li>
                                                      <a  href="<?php echo $global['webSiteRootURL']; ?>mvideos?link=1" >
                                                          <span class="fa fa-link"></span> <?php echo __("Embed a video link"); ?>
                                                      </a>
                                                  </li>
                                                  <?php
                                              }
                                              ?>
                                          </ul>
                                      <?php
                                      }
                                      else{
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
                          <li>
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
                                          buttonType: "btn-default navbar-btn",
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
