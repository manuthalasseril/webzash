<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Webzash<?php if (isset($page_title)) echo ' | ' . $page_title; ?></title>

<?php echo link_tag(asset_url() . 'images/favicon.ico', 'shortcut icon', 'image/ico'); ?>

<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/admin-style.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/tables.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/custom.css">
<link type="text/css" rel="stylesheet" href="<?php echo asset_url(); ?>css/jquery.datepick.css">

<script type="text/javascript">
	var jsSiteUrl = '<?php echo base_url(); ?>';
</script>

<script type="text/javascript" src="<?php echo asset_url(); ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo asset_url(); ?>js/jquery.datepick.js"></script>
<script type="text/javascript" src="<?php echo asset_url(); ?>js/custom.js"></script>
<script type="text/javascript" src="<?php echo asset_url(); ?>js/hoverIntent.js"></script>
<script type="text/javascript" src="<?php echo asset_url(); ?>js/superfish.js"></script>
<script type="text/javascript" src="<?php echo asset_url(); ?>js/supersubs.js"></script>
<script type="text/javascript" src="<?php echo asset_url(); ?>js/shortcutslibrary.js"></script>
<script type="text/javascript" src="<?php echo asset_url(); ?>js/shortcuts.js"></script>

<script type="text/javascript">
/* Loading JQuery Superfish menu */
$(document).ready(function(){ 
	$("ul.sf-menu").supersubs({ 
		minWidth:12,
		maxWidth:27,
		extraWidth: 1
	}).superfish(); // call supersubs first, then superfish, so that subs are 
});
</script>

</head>
<body>
<div id="container">
	<div id="header">
		<div id="logo">
		<?php echo anchor('admin', 'Webzash', array('class' => 'anchor-link-b')); ?>  <span id="admin-area">Admin area</span>
		</div>
		<?php
			if ($this->session->userdata('user_name')) {
				echo "<div id=\"admin\">";
				echo anchor('', 'Accounts', array('title' => "Accounts", 'class' => 'anchor-link-b'));
				echo " | ";
				/* Check if allowed administer rights */
				if (check_access('administer')) {
					echo anchor('admin', 'Administer', array('title' => "Administer", 'class' => 'anchor-link-b'));
					echo " | ";
				}
				echo anchor('user/profile', 'Profile', array('title' => "Profile", 'class' => 'anchor-link-b'));
				echo " | ";
				echo anchor('user/logout', 'Logout', array('title' => "Logout", 'class' => 'anchor-link-b'));
				echo "</div>";
			}
		?>
		<div id="info">
		</div>
	</div>
	<div id="menu">
	</div>
	<div id="content">
		<div id="sidebar">
			<?php if (isset($page_sidebar)) echo $page_sidebar; ?>
		</div>
		<div id="main">
			<div id="main-title">
				<?php if (isset($page_title)) echo $page_title; ?>
			</div>
			<?php if (isset($nav_links)) {
				echo "<div id=\"main-links\">";
				echo "<ul id=\"main-links-nav\">";
				foreach ($nav_links as $link => $title) {
					echo "<li>" . anchor($link, $title, array('title' => $title, 'class' => 'nav-links-item', 'style' => 'background-image:url(\'' . asset_url() . 'images/buttons/navlink.png\');')) . "</li>";
				}
				echo "</ul>";
				echo "</div>";
			} ?>
			<div class="clear">
			</div>
			<div id="main-content">
				<?php
				$messages = $this->messages->get();
				if (is_array($messages))
				{
					if (count($messages['success']) > 0)
					{
						echo "<div id=\"success-box\">";
						echo "<ul>";
						foreach ($messages['success'] as $message) {
							echo ('<li>' . $message . '</li>');
						}
						echo "</ul>";
						echo "</div>";
					}
					if (count($messages['error']) > 0)
					{
						echo "<div id=\"error-box\">";
						echo "<ul>";
						foreach ($messages['error'] as $message) {
							if (substr($message, 0, 4) == "<li>")
								echo ($message);
							else
								echo ('<li>' . $message . '</li>');
						}
						echo "</ul>";
						echo "</div>";
					}
					if (count($messages['message']) > 0)
					{
						echo "<div id=\"message-box\">";
						echo "<ul>";
						foreach ($messages['message'] as $message) {
							echo ('<li>' . $message . '</li>');
						}
						echo "</ul>";
						echo "</div>";
					}
				}
				?>
				<?php echo $contents; ?>
			</div>
		</div>
	</div>
</div>
<div id="footer">
	<?php if (isset($page_footer)) echo $page_footer ?>
	<a href="http://webzash.org" target="_blank">Webzash<a/> is licensed under <a href="http://www.gnu.org/licenses/agpl-3.0.txt" target="_blank">GNU Affero General Public License, version 3</a> as published by the Free Software Foundation.
</div>
</body>
</html>
