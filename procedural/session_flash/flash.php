<?php 	

	/**/


	if ( ! function_exists('setFlash'))
	{
		function setFlash($message , $type = 'success', $name = null)
		{
			$defaultFlashName = 'dft_flash_name';

			//if flashName is null then flashName will be default flash name
			$name = $name ?? $defaultFlashName;

			//check if flash messages exists in session
			if(!getSession('flashMessages'))
				setSession('flashMessages' , array());

			//get instance of flash messages
			$flashMessages = getSession('flashMessages');

			

			//set the content of the session
			$flashSession = [
				'name' => $name,
				'message' => $message,
				'type' => $type
			];

			$flashMessages [] = $flashSession;

			setSession('flashMessages' , $flashMessages);
		}
	}


	//flash design will only work with bootstrap alerts.
	if( ! function_exists('flash'))
	{
		function flash($flashName = null)
		{
			$defaultFlashName = 'dft_flash_name';

			$flashMessages = getSession('flashMessages');

			if(empty($flashMessages)) 
				return null;


			$className = '';
			$message   = '';

			foreach($flashMessages as $key => $flash)
			{
				if(is_null($flashName)) 
				{
					if(strcasecmp($flash['name'], $defaultFlashName) === 0)
					{
						$className = $flash['type'];
						$message   = $flash['message'];

						//destroy message 
						unset($flashMessages[$key]);
						break;
					}
				}

				if(strcasecmp($flash['name'] , $flashName) === 0)
				{
					$className = $flash['type'];
					$message   = $flash['message'];
					unset($flashMessages[$key]);
					break;
				}
			}

			if(!empty($className) && !empty($message))
			{
	            print <<< EOF
                <div class="alert alert-{$className} fade in alert-dismissible show"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    	<span aria-hidden="true" style="font-size:20px">×</span>
                    </button>
                    {$message}
                </div>
                EOF;
			}

			//set new flash message

			setSession('flashMessages' , $flashMessages);

		}

	}else{
		die('FNC:: cannot re-declare flash');
	}


	//get array of flash if parameter is set to empty array
	if( ! function_exists('getFlash') )
	{
		function getFlash($flash = false)
		{
			$defaultFlashName = 'dft_flash_name';


			if(is_array($flash)) {

			}
			//if no flash is set return false
			if(!getSession($defaultFlashName) && !getSession($defaultFlashName.'_class'))
				return false;
		}
	}

