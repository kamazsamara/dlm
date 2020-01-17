<?php
session_start();

/**
* Adpanel Dalimo
*
* Main file
* 
* @author kamaz__ <soldier.m@mail.ru>
* @version 1.2
* @package All files
*/



	require_once "config/sysconfig.php";
	require_once "classes/func.php";
	require_once "modules/check.php";
	require_once "modules/relocation.php";
	require_once "modules/templater.php";

	$db 		= new	 Database;
	$main_page 	= new 	 Templater;
	
	if(!@$_SESSION['u'] || !@$_SESSION['us'])
	{
		location::set("login");
	}

	if(@$_SESSION['u'] & @$_SESSION['us'])
	{
		if(in_array((trim(@$_SESSION['us'])),$user_array))
		{
			if($_SESSION['u'] == md5(md5($pass_array[@$_SESSION['us']])))
			{
				$main_page->data['{USERNAME}'] = $_SESSION['us'];
				$main_page->data['{STATISTIC}'] = "Статистика";
				
				require_once "modules/dest.php";
				require_once "modules/files.php";
				require_once "modules/cats.php";
				require_once "modules/news.php";			
				require_once "modules/subs.php";
				require_once "modules/logs.php";
				require_once "modules/report.php";
				require_once "modules/users.php";
				require_once "modules/counters.php";
		
			
					echo $main_page->parse($data);
			}
			else
			{
				location::set("login");
			}
		}
		else
		{
			location::set("login");
		}
	}
	else
	{
		location::set("login");
	}
?>