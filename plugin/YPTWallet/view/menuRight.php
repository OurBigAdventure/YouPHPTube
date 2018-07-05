<?php
if (!User::isLogged()) {
    return;
}
$plugin = YouPHPTubePlugin::loadPluginIfEnabled("YPTWallet");
$obj = $plugin->getDataObject();
$balance = $plugin->getBalance(User::getId());
?>
<style>
</style>
<li>
    <div class="btn-group">
        <button type="button" class="btn btn-light  dropdown-toggle nav-item float-left"  data-toggle="dropdown">
            <?php echo $obj->wallet_button_title; ?> <span class="badge badge-dark"><?php echo $obj->currency_symbol; ?> <span class="walletBalance"><?php echo number_format($balance, $obj->decimalPrecision); ?></span> <?php echo $obj->currency; ?></span></span> <span class="caret"></span>
        </button>
        <div class="dropdown-menu dropdown-menu-right" role="menu">
            <?php
            if($obj->enableAutomaticAddFundsPage){
            ?>
                <a class="dropdown-item" tabindex="-1" href="<?php echo $global['webSiteRootURL']; ?>plugin/YPTWallet/view/addFunds.php">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <?php echo __("Add Funds"); ?>
                </a>
            <?php
            }
            if($obj->enableManualAddFundsPage){
            ?>
                <a class="dropdown-item" tabindex="-1" href="<?php echo $global['webSiteRootURL']; ?>plugin/YPTWallet/view/manualAddFunds.php">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    <?php echo $obj->manualAddFundsMenuTitle; ?>
                </a>
            </li>
            <?php
            }
            if($obj->enableManualWithdrawFundsPage){
            ?>
                <a class="dropdown-item" tabindex="-1" href="<?php echo $global['webSiteRootURL']; ?>plugin/YPTWallet/view/manualWithdrawFunds.php">
                    <i class="far fa-money-bill-alt" aria-hidden="true"></i>
                    <?php echo $obj->manualWithdrawFundsMenuTitle; ?>
                </a>
            <?php
            }
            ?>
                <a class="dropdown-item" tabindex="-1" href="<?php echo $global['webSiteRootURL']; ?>plugin/YPTWallet/view/transferFunds.php">
                    <i class="fas fa-exchange-alt" aria-hidden="true"></i>
                    <?php echo __("Transfer Funds"); ?>
                </a>
                <a class="dropdown-item" tabindex="-1" href="<?php echo $global['webSiteRootURL']; ?>plugin/YPTWallet/view/history.php">
                    <i class="fa fa-history" aria-hidden="true"></i>
                    <?php echo __("History"); ?>
                </a>
                <a class="dropdown-item" tabindex="-1" href="<?php echo $global['webSiteRootURL']; ?>plugin/YPTWallet/view/configuration.php">
                    <i class="fas fa-cog" aria-hidden="true"></i>
                    <?php echo __("Configuration"); ?>
                </a>
            <?php
            if (User::isAdmin()) {
                $total = WalletLog::getTotalFromWallet(0,true,'pending');
                ?>
                <div class="dropdown-header">Admin Menu</div>
                    <a class="dropdown-item" tabindex="-1" href="<?php echo $global['webSiteRootURL']; ?>plugin/YPTWallet/view/adminManageWallets.php">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <?php echo __("Manage Wallets"); ?>
                    </a>
                    <a class="dropdown-item" tabindex="-1" href="<?php echo $global['webSiteRootURL']; ?>plugin/YPTWallet/view/pendingRequests.php">
                        <i class="far fa-clock" aria-hidden="true"></i>
                        <?php echo __("Pending Requests"); ?> <span class="badge badge-dark"><?php echo $total; ?></span>
                    </a>
                <?php
            }
            ?>
        </div>
    </div>

</li>

<script>
    $(document).ready(function () {
    });
</script>
