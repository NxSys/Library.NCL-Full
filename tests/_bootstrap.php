<?php
// This is global bootstrap for autoloading

//Use non-ignorant autoloader
// because phars are a case affected by phpbug #49625

//Here we use a conditional declaration in case more than one library is using this shim
// also note the naming syntax. We deliberately use a long name to avoid collisions
// and if consulting a list of declared functions, the prefix _SHIM makes this
// easy to identify
if (!function_exists('_SHIM_MATCH_CLASSFILE_ASIS_LOADER'))
{
  function _SHIM_MATCH_CLASSFILE_ASIS_LOADER($class)
	{
		//we break out include paths in an OS agnostic way
		$aPaths=explode(PATH_SEPARATOR, get_include_path());

		//this allows the NS separator to operate uniformly as DIRECTORY_SEPARATOR
		// across OSs
		if('\\' !== DIRECTORY_SEPARATOR)
		{
			$class=str_replace('\\', DIRECTORY_SEPARATOR, $class);
		}

		//the default implementation of spl_autoload has a short (two) list
		// of file extensions that it looks for, of which .php is on the end.
		// for efficiency's sake we reverse the list to save on those cycles.
		$aExts=array_reverse(explode(',', spl_autoload_extensions()));

		//for each include path...
		foreach ($aPaths as $sBasePath)
		{
			// and then for each file extension..
			foreach($aExts as $ext)
			{
				//we now join them all together for a functional path
				$cpath=$sBasePath.DIRECTORY_SEPARATOR.$class.$ext;

				//and we now check to see if we actually
				// can use the proposed class path
				if (is_readable($cpath))
				{
					//we can, fantastic. lets move one with our lives!
					require_once $cpath;
					return true;
				}
				//if not, lets exhaust..
			}
			//.. all options
		}
		// all class path proposals have failed
		return false;
	}
	//here we register the function
	spl_autoload_register('_SHIM_MATCH_CLASSFILE_ASIS_LOADER');
}

spl_autoload_register();
