<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Procentris Internal Management System ');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('menu');
                echo $this->Html->css('search');
		echo $this->Html->script('jquery-1.11.1.min');


		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
                    <table style="margin-bottom: 0px;">
                        <tr style="background: none;">
                            <td style="border-bottom:0px; padding:0px; vertical-align: middle" width="20%">
                                <?php echo $this->Html->image('procentris.gif', array('alt' => 'Procentris Inventory Management System')); ?>
                            </td>
                            <td style="border-bottom:0px; padding:0px; vertical-align: middle; text-align: center" width="60%">
                                <h2>Hardware Inventory Management System<h2>
                            </td>
                            <td style="border-bottom:0px; padding:0px; vertical-align: middle; text-align: right" width="20%">
                                <?php echo $this->Html->link(__('Logout'), array('controller' => 'Users', 'action' => 'logout'), array('style'=>"color:#283785")); ?>
                            </td>
                        </tr>
                    </table>

		</div>
            <div id="content">

                <nav id="menu-wrap"><div id="menu-trigger">Menu</div>
                    <ul id="menu">
                        <?php if($this->params['controller'] == 'SystemDetails' && $this->params['action'] == 'home') {
                            $homeStyle = 'style="background-color: #029BD5;"';;
                        } else {
                            $homeStyle = '';
                        }
                        ?>
                        <li <?php echo $homeStyle; ?>><?php echo $this->Html->link(__('Home'), array('controller' => 'pages', 'action' => 'display')); ?></li>

                        <?php if($this->params['controller'] == 'SystemDetails' && $this->params['action'] != 'home' && $this->params['action'] != 'export' ) {
                            $sysStyle = 'style="background-color: #029BD5;"';;
                        } else {
                            $sysStyle = '';
                        }
                        ?>

                        <li <?php echo $sysStyle; ?>>
                            <a href="javascript:void(0)">Systems</a>
                            <?php //echo $this->Html->link(__('Systems'), array('controller' => 'SystemDetails', 'action' => 'index')); ?>
                            <ul>
                                <li>
                                    <?php echo $this->Html->link(__('View'), array('controller' => 'SystemDetails', 'action' => 'index')); ?>
                                </li>
                                <li>
                                    <?php echo $this->Html->link(__('Add New'), array('controller' => 'SystemDetails', 'action' => 'add')); ?>
                                </li>
                            </ul>
                        </li>
                        <?php if($this->params['controller'] == 'Locations') {
                            $locStyle = 'style="background-color: #029BD5;"';;
                        } else {
                            $locStyle = '';
                        }
                        ?>
                        <li <?php echo $locStyle; ?>>
                            <a href="javascript:void(0)">Locations</a>
                            <?php //echo $this->Html->link(__('Locations'), array('controller' => 'Locations', 'action' => 'index')); ?>
                            <ul>

                                <li>
                                    <?php echo $this->Html->link(__('View'), array('controller' => 'Locations', 'action' => 'index')); ?>

                                </li>
                                <li>
                                    <?php echo $this->Html->link(__('Add New'), array('controller' => 'Locations', 'action' => 'add')); ?>
                                </li>

                            </ul>
                        </li>
                        <?php if($this->params['controller'] == 'Users') {
                            $usrStyle = 'style="background-color: #029BD5;"';;
                        } else {
                            $usrStyle = '';
                        }
                        ?>
                        <li <?php echo $usrStyle; ?>>
                            <a href="javascript:void(0)">Users</a>
                            <?php //echo $this->Html->link(__('Users'), array('controller' => 'Users', 'action' => 'index')); ?>
                        <ul>
                                <li>
                                    <?php echo $this->Html->link(__('View'), array('controller' => 'Users', 'action' => 'index')); ?>
                                </li>
                                <li>
                                    <?php echo $this->Html->link(__('Add New'), array('controller' => 'Users', 'action' => 'add')); ?>
                                </li>
                            </ul>
                        </li>
<!--                        <li><a href="">Reports</a></li>-->
                        <?php if($this->params['controller'] == 'SystemDetails' && $this->params['action'] == 'export') {
                            $expStyle = 'style="background-color: #029BD5;"';;
                        } else {
                            $expStyle = '';
                        }
                        ?>
                        <li <?php echo $expStyle; ?>><?php echo $this->Html->link(__('Export'), array('controller' => 'SystemDetails', 'action' => 'export')); ?></li>
                        <li style="float:right; margin-right: 0px;">
                            <form method="post" action="" class="search-form frame inbtn rlarge" id="searchForm">
                                <input type="text" name="search" id="globalSearch" class="search-input" placeholder="Search..." />
                                <input class="search-btn" type="submit" value="Go" id="globalSearchBtn" />
                            </form>
                        </li>
                    </ul>
                </nav>
                <?php echo $this->Session->flash(); ?>

                <?php echo $this->fetch('content'); ?>
            </div>
		<div id="footer">

		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
<script type="text/javascript">
//    $(function() {
//		if ($.browser.msie && $.browser.version.substr(0,1)<7)
//		{
//		$('li').has('ul').mouseover(function(){
//			$(this).children('ul').css('visibility','visible');
//			}).mouseout(function(){
//			$(this).children('ul').css('visibility','hidden');
//			})
//		}
//
//		/* Mobile */
//		$('#menu-wrap').prepend('<div id="menu-trigger">Menu</div>');
//		$("#menu-trigger").on("click", function(){
//			$("#menu").slideToggle();
//		});
//
//		// iPad
//		var isiPad = navigator.userAgent.match(/iPad/i) != null;
//		if (isiPad) $('#menu ul').addClass('no-transition');
//    });
</script>
</html>
