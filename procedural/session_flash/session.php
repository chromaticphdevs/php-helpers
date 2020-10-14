<?php

	/*
	*In order for this code to work
	*you should instanciate session_start on your page
	*/

	/*
	*Or uncomment this
	* session_start();
	*/

	/*
	*Create new session
	*/

	if( !function_exists('setSession'))
	{
		function setSession($name , $value)
		{
			$name = strtolower($name);

			$_SESSION[$name] = $value;
		}
	}


	/*
	*Returns empty if session does not exists
	*otherwise returns the session value
	*/
	if( !function_exists('getSession'))
	{
		function getSession($name)
		{

			if(is_array($name))
			{
				return $_SESSION;
			}else{
				$name = strtolower($name);

				if(isset($_SESSION[$name]))
	            	return $_SESSION[$name];
	        	return '';
			}
			
		}
	}

	/*
	*Unset session if exists
	*you can pass array to delete multiple sessions
	*/
	if( !function_exists('destroySession'))
	{
		function destroySession($sessionName = null)
		{
			if(!is_array($sessionName) && !is_null($sessionName))
			{
				$sessionName = strtolower($sessionName);

				if( !empty( getSession($sessionName)))
				unset( $_SESSION[$sessionName]);
			}

			if(is_array($sessionName)){

				foreach($sessionName as $name) 
				{
					$name = strtolower($name);
					if( !empty( getSession($name)))
					unset( $_SESSION[$name]);
				}
			}

			if(is_null($sessionName)) 
				session_destroy();
		}
	}
?>