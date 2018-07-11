<?php
global $global, $config;
if(!isset($global['systemRootPath'])){
    require_once '../videos/configuration.php';
}
require_once $global['systemRootPath'] . 'objects/user.php';

$json_file = url_get_contents("{$global['webSiteRootURL']}plugin/CustomizeAdvanced/advancedCustom.json.php");
// convert the string to a json object
$advancedCustom = json_decode($json_file);
if(!empty($advancedCustom->disableNativeSignUp)){
    die(__("Sign Up Disabled"));
}

$agreement = YouPHPTubePlugin::loadPluginIfEnabled("SignUpAgreement");
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['language']; ?>">
    <head>
        <title><?php echo $config->getWebSiteTitle(); ?> :: <?php echo __("User"); ?></title>
        <?php
        include $global['systemRootPath'] . 'view/include/head.php';
        ?>
    </head>

    <body>
        <?php
        include $global['systemRootPath'] . 'view/include/navbar.php';
        ?>

        <div class="container">


            <div class="row">
                <div class="col-1 col-sm-1 col-lg-2"></div>
                <div class="col-10 col-sm-10 col-lg-8">
                    <form class="form-compact well "  id="updateUserForm" onsubmit="">
                        <fieldset>
                            <legend><?php echo __("Sign Up"); ?></legend>

                            <div class="form-inline mb-2">
                                <label class="col-md-4 col-form-label"><?php echo __("Name"); ?></label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-pencil-alt"></i></div></div>
                                        <input  id="inputName" placeholder="<?php echo __("Name"); ?>" class="form-control"  type="text" value="" required >
                                    </div>
                                </div>
                            </div>

                            <div class="form-inline mb-2">
                                <label class="col-md-4 col-form-label"><?php echo __("User"); ?></label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-user"></i></div>
                                      </div>
                                        <input  id="inputUser" placeholder="<?php echo __("User"); ?>" class="form-control"  type="text" value="" required >
                                    </div>
                                </div>
                            </div>

                            <div class="form-inline mb-2">
                                <label class="col-md-4 col-form-label"><?php echo __("E-mail"); ?></label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                                      </div>
                                        <input  id="inputEmail" placeholder="<?php echo __("E-mail"); ?>" class="form-control"  type="email" value="" required >
                                    </div>
                                </div>
                            </div>

                            <div class="form-inline mb-2">
                                <label class="col-md-4 col-form-label"><?php echo __("New Password"); ?></label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                      </div>
                                        <input  id="inputPassword" placeholder="<?php echo __("New Password"); ?>" class="form-control"  type="password" value="" >
                                    </div>
                                </div>
                            </div>

                            <div class="form-inline mb-2">
                                <label class="col-md-4 col-form-label"><?php echo __("Confirm New Password"); ?></label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-lock"></i></div>
                                      </div>
                                        <input  id="inputPasswordConfirm" placeholder="<?php echo __("Confirm New Password"); ?>" class="form-control"  type="password" value="" >
                                    </div>
                                </div>
                            </div>

                            <?php
                            if(!empty($agreement)){
                                $agreement->getSignupCheckBox();
                            }
                            ?>

                            <div class="form-inline mb-2">
                                <label class="col-md-4 col-form-label"><?php echo __("Type the code"); ?></label>
                                <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><img src="<?php echo $global['webSiteRootURL']; ?>captcha" id="captcha"></span>
                                        <span class="input-group-text"><span class="btn-sm btn-success" id="btnReloadCapcha"><span class="fas fa-sync"></span></span></span>
                                      </div>
                                        <input name="captcha" placeholder="<?php echo __("Type the code"); ?>" class="form-control" type="text" maxlength="5" id="captchaText">
                                    </div>
                                </div>
                            </div>


                            <!-- Button -->
                            <div class="form-inline">
                                <label class="col-md-4 col-form-label"></label>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary" ><?php echo __("Save"); ?> <span class="glyphicon glyphicon-save"></span></button>
                                </div>
                            </div>
                        </fieldset>
                    </form>

                </div>
                <div class="col-1 col-sm-1 col-lg-8"></div>
            </div>
            <script>
                $(document).ready(function () {

                    $('#btnReloadCapcha').click(function () {
                        $('#captcha').attr('src', '<?php echo $global['webSiteRootURL']; ?>captcha?' + Math.random());
                        $('#captchaText').val('');
                    });
                    $('#updateUserForm').submit(function (evt) {
                        evt.preventDefault();
                        modal.showPleaseWait();
                        var pass1 = $('#inputPassword').val();
                        var pass2 = $('#inputPasswordConfirm').val();
                        // password dont match
                        if (pass1 != '' && pass1 != pass2) {
                            modal.hidePleaseWait();
                            swal("<?php echo __("Sorry!"); ?>", "<?php echo __("Your password does not match!"); ?>", "error");
                            return false;
                        } else {
                            $.ajax({
                                url: '<?php echo $global['webSiteRootURL']; ?>objects/userCreate.json.php',
                                data: {
                                    "user": $('#inputUser').val(),
                                    "pass": $('#inputPassword').val(),
                                    "email": $('#inputEmail').val(),
                                    "name": $('#inputName').val(),
                                    "captcha": $('#captchaText').val()
                                },
                                type: 'post',
                                success: function (response) {
                                    if (response.status > 0) {
                                        swal({
                                            title: "<?php echo __("Congratulations!"); ?>",
                                            text: "<?php echo __("Your user has been created!"); ?>",
                                            type: "success"
                                        },
                                                function () {
                                                    window.location.href = '<?php echo $global['webSiteRootURL']; ?>user';
                                                });
                                    } else {
                                        if (response.error) {
                                            swal("<?php echo __("Sorry!"); ?>", response.error, "error");
                                        } else {
                                            swal("<?php echo __("Sorry!"); ?>", "<?php echo __("Your user has NOT been created!"); ?>", "error");
                                        }
                                    }
                                    modal.hidePleaseWait();
                                }
                            });
                            return false;
                        }
                    });
                });
            </script>
        </div><!--/.container-->

        <?php
        include $global['systemRootPath'] . 'view/include/footer.php';
        ?>

    </body>
</html>
