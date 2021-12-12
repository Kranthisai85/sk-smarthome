<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_login
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
?>
<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure', 0)); ?>" method="post" id="login-form" class="form-vertical">
<div class="module modlogin">
	<a class="dropdown-toggle">
		<i class="icon-man-avatar" aria-hidden="true"></i>
		<?php echo JText::_('MOD_MYACCOUNT'); ?>
	</a>
	<ul class="yt-loginform dropdown-menu">
		<li class="account" id="my_account">
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=profile'); ?>" title="<?php echo JText::_('MOD_MYACCOUNT'); ?>"><?php echo JText::_('MOD_MYACCOUNT'); ?></a>
		</li>
		<li class="order" id="my_order">
			<a href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=orders&layout=list'); ?>" title="<?php echo JText::_('MOD_MYORDER'); ?>"><?php echo JText::_('MOD_MYORDER'); ?></a>
		</li>
		<li class="logout"><input type="submit" name="Submit" class="btn btn-primary" value="<?php echo JText::_('JLOGOUT'); ?>" /></li>
	</ul>

	<div class="logout-button">
		<!--input type="submit" name="Submit" class="btn btn-primary" value="<?php echo JText::_('JLOGOUT'); ?>" /-->
		<input type="hidden" name="option" value="com_users" />
		<input type="hidden" name="task" value="user.logout" />
		<input type="hidden" name="return" value="<?php echo $return; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</div>
</form>
<script type="text/javascript">
jQuery(document).ready(function($) {
    var ua = navigator.userAgent,
    _device = (ua.match(/iPad/i)||ua.match(/iPhone/i)||ua.match(/iPod/i)) ? "smartphone" : "desktop";

    if(_device == "desktop") {
        $(".modlogin").bind('hover', function() {
            $(this).children(".dropdown-toggle").addClass(function(){
                if($(this).hasClass("open")){
                    $(this).removeClass("open");
                    return "";
                }
                return "open";
            });
            $(this).stop().children(".dropdown-menu").slideToggle('300');
        });
    }else{
        $('.mod-login .dropdown-toggle').bind('touchstart', function(){
            $('.mod-login .dropdown-menu').toggle();
        });
    }
});
</script>