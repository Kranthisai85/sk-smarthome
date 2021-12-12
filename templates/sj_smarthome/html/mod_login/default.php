<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_login
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.keepalive');

?>
<div class="module modlogin">

<?php if ($type == 'logout') : ?>
	<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="logout-form">
	<?php if ($params->get('greeting')) : ?>
		<div class="login-greeting">
		<i class="fa fa-user" aria-hidden="true"></i>
		<?php if($params->get('name') == 0) : {
			echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('name')));
		} else : {
			echo JText::sprintf('MOD_LOGIN_HINAME', htmlspecialchars($user->get('username')));
		} endif; ?>
		</div>
	<?php endif; ?>
		<div class="logout-button">
			<input type="submit" name="Submit" class="btn" value="<?php echo JText::_('JLOGOUT'); ?>" />
			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="user.logout" />
			<input type="hidden" name="return" value="<?php echo $return; ?>" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
<?php else : ?>
	<a class="dropdown-toggle">
		<i class="icon-man-avatar" aria-hidden="true"></i>
		<?php echo JText::_('MOD_MYACCOUNT'); ?>
	</a>
	<ul class="yt-loginform dropdown-menu">
        <li class="yt-login">
		
		<a class="login-switch" data-toggle="modal" href="#myLogin" title="<?php  echo JText::_('MOD_SING_IN');?>">
		  <?php echo JText::_('MOD_SING_IN');?>
		</a>
		
        </li>
		<li class="yt-register">
			<?php
			$usersConfig = JComponentHelper::getParams('com_users');
			if ($usersConfig->get('allowUserRegistration')) : ?>
				<a 
					class="register-switch" 
					href="<?php echo JRoute::_("index.php?option=com_users&view=registration");?>">
					<?php echo JText::_('MOD_REGISTER');?>
				</a>
			<?php endif; ?>	
        </li >
		<li class="account" id="my_account">
			<a href="<?php echo JRoute::_('index.php?option=com_users&view=profile'); ?>" title="<?php echo JText::_('MOD_MYACCOUNT'); ?>"><?php echo JText::_('MOD_MYACCOUNT'); ?></a>
		</li>
		<li class="order" id="my_order">
			<a href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=orders&layout=list'); ?>" title="<?php echo JText::_('MOD_MYORDER'); ?>"><?php echo JText::_('MOD_MYORDER'); ?></a>
		</li>
        
    </ul>
	<div id="myLogin" class="modal fade" tabindex="-1" role="dialog"  aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<h3 class="title"><?php echo JText::_('MOD_SING_IN'); ?>  </h3>
					<form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" id="login-form" >
						<?php if ($params->get('pretext')): ?>
							<div class="pretext">
							<p><?php echo $params->get('pretext'); ?></p>
							</div>
						<?php endif; ?>
						<div class="userdata">
							<div id="form-login-username" class="form-group">
								<label for="modlgn-username"><?php echo JText::_('MOD_LOGIN_VALUE_USERNAME') ?></label>
								<input id="modlgn-username" type="text" name="username" class="inputbox"  size="40" />
							</div>
							<div id="form-login-password" class="form-group">
								<label for="modlgn-passwd"><?php echo JText::_('JGLOBAL_PASSWORD') ?></label>
								<input id="modlgn-passwd" type="password" name="password" class="inputbox" size="40"  />
							</div>
							
							<div id="form-login-remember" class="form-group ">
								<input id="modlgn-remember" type="checkbox" name="remember" value="1"/>
								<label for="modlgn-remember" class="control-label"><?php echo JText::_('MOD_LOGIN_REMEMBER_ME') ?></label> 
							</div>
							
							
							<div id="form-login-submit" class="control-group">
								<div class="controls">
									<button type="submit" tabindex="3" name="Submit" class="button"><?php echo JText::_('JLOGIN') ?></button>
								</div>
							</div>
							
							<input type="hidden" name="option" value="com_users" />
							<input type="hidden" name="task" value="user.login" />
							<input type="hidden" name="return" value="<?php echo $return; ?>" />
							<?php echo JHtml::_('form.token'); ?>
						</div>
						<ul class="listinline listlogin">
							<li>
								<a href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>">
								<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_PASSWORD'); ?></a>
							</li>
							<li>
								<a href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>">
								<?php echo JText::_('MOD_LOGIN_FORGOT_YOUR_USERNAME'); ?></a>
							</li>
							
						</ul>
						<?php if ($params->get('posttext')): ?>
							<div class="posttext">
								<p><?php echo $params->get('posttext'); ?></p>
							</div>
						<?php endif; ?>
						
					</form>
		
					<a href="<?php echo JRoute::_("index.php?option=com_users&view=registration");?>" onclick="showBox('yt_register_box','jform_name',this, window.event || event);return false;" class="btReverse">Create an account</a>
				</div>
			</div>
		</div>
<?php endif; ?>
</div>
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