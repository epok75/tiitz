<?php

class FileManager
{
	private $currentPath;
	private $root;
	private $item_info;
	private $error;
	
	public function __construct ($root_param)
	{
		$this->root = $root_param;
		$this->error = "";
	}
	
	public function set_currentItem ($path = "../../")
	{
		if (is_dir($path) || is_file($path))
			$this->currentPath = $path;
		else
		{
			$this->error = "L'&eacutel&eacute;ment choisis n'est pas valide.";
			return FALSE;
		}
	}
	
	public function get_lastError()
	{
		if (!empty($this->error))
			return $this->error;
		else
			return FALSE;
	}
	
	public function get_root()
	{
		return $this->root;
	}
	
	public function get_itemInfos()
	{
		$i = 0;
		if (is_file($this->currentPath))
		{
			$fp = $this->xfopen("r");
			$stats = fstat($fp);
			$this->xfclose($fp);
			$infos["Type"] = "Fichier";
			$infos["Size"] = $stats["size"];
		}
		else if (is_dir($this->currentPath))
		{
			$dp = $this->xopendir($this->currentPath);
			while($Entry = $this->xreaddir($dp))
				$i++;
			$infos["Size"] = $i;
			$infos["Type"] = "Dossier";
		}
		$infos["Name"] = basename($this->currentPath);
		$infos["Path"] = dirname($this->currentPath);
		return $infos;
	}
	
	public function get_currentItem()
	{
		return($this->currentPath);
	}
	
	private function xfopen($mode)
	{
		if (file_exists($this->currentPath) && is_file($this->currentPath))
		{
			$handle = fopen($this->currentPath, $mode);
			if ($handle == false)
			{
				$this->error = "Impossible d'ouvrir le fichier.";
				return FALSE;
			}
			else
				return ($handle);
		}
		else
		{
			$this->error = "L'&eacutel&eacute;ment choisis n'est pas valide.";
			return FALSE;
		}
	}

	private function xfread($handle, $lenght)
	{
		$lenght = $lenght + 1;
		if ($handle != false)
		{
			$lenght = ($lenght*$lenght)/$lenght;
			$buffer = fread($handle, $lenght);
			if ($buffer == false)
			{
				$this->error = "Impossible de lire le fichier.";
				return FALSE;
			}
			else
				return ($buffer);
		}
		else
		{
			$this->error = "La ressource fournie n'est pas valide.";
			return FALSE;
		}
	}
	
	public function get_fileContent()
	{
		$handle = $this->xfopen("r+");
		$return = $this->xfread($handle, filesize($this->currentPath)*10);
		$this->xfclose($handle);
		return $return;
	}
	
	public function replace_fileContent($str)
	{
		$handle = $this->xfopen("w+");
		$return = $this->xfwrite($handle, $str);
		$this->xfclose($handle);
		return $return;
	}
	
	public function add_fileContent($str)
	{
		$handle = $this->xfopen("a");
		$return = $this->xfwrite($handle, $str);
		$this->xfclose($handle);
		return $return;
	}
	
	private function xfwrite ($handle, $str)
	{
		if ($handle != false && $str != null)
		{
			$new_chars = fwrite($handle, $str);
			if ($new_chars != false)
				return ($new_chars);
			else
			{
				$this->error = "Echec de l'&eacute;criture dans le fichier.";
				return FALSE;
			}
		}
		else
		{
			$this->error = "La ressource fournie n'est pas valide.";
			return FALSE;	
		}
	}
	
	private function xfclose ($handle)
	{
		if ($handle != false)
		{
			$return = fclose($handle);
			if ($return == false)
			{
				$this->error = "Echec de la fermeture du fichier.";
				return FALSE;
			}
			else
				return ($return);
		}
		else
		{
			$this->error = "La ressource fournie n'est pas valide.";
			return FALSE;
		}
	}
	
	public function xrename ($newname)
	{
		if (file_exists($this->currentPath) || is_dir($this->currentPath))
		{
			$return = rename($this->currentPath, $newname);
			if ($return == false)
			{
				$this->error = "L'op&eacute;ration de rennomage a &eacute;chou&eacute;.";
				return false;
			}
			else
			{
				$this->set_currentItem($newname);
				return true;
			}
		}
		else
		{
			$this->error = "L'&eacutel&eacute;ment choisis n'est pas valide.";
			return false;
		}
	}
	
	private function xopendir()
	{
		if (file_exists($this->currentPath) && is_dir($this->currentPath))
		{
			$handle = opendir($this->currentPath);
			if ($handle == false)
			{
				$this->error = "Probl&egrave;me lors de l'ouverture du dossier.";
				return FALSE;
			}
			else
				return ($handle);
		}
		else
		{
			$this->error = "L'&eacutel&eacute;ment choisis n'est pas valide.";
			return FALSE;
		}
	}

	public function xreaddir($handle)
	{
		if ($handle != false)
		{
			return (readdir($handle));
		}
		else
		{
			$this->error = "La ressource fournie n'est pas valide.";
			return FALSE;
		}
	}

	private function xclosedir($handle)
	{
		if ($handle != null)
		{
			$return = closedir($handle);
			if ($return == false)
			{
				$this->error = "Impossible de fermer cet &eacute;l&eacute;ment.";
				return FALSE;
			}
			else
				return ($return);
		}
		else
		{
			$this->error = "La ressource fournie n'est pas valide.";
			return FALSE;
		}
	}

	public function  ls()
	{
		$tab = array();
		$handle = $this->xopendir($this->currentPath);
		while ($contents = $this->xreaddir($handle))
		{
			array_push($tab, $contents);
		}
		return $tab;
	}
	
	private function xrmdir ($handle)
	{
		if ($handle != false)
		{
			$return = rmdir($handle);
			if ($return == false)
			{
				$this->error = "La suppression du dossier a eacute;chou&eacute;";
				return FALSE;
			}
			else
				return ($return);
		}
		else
		{
			$this->error = "La ressource fournie n'est pas valide.";
			return FALSE;
		}
	}
	
	private function xunlink ($handle)
	{
		if ($handle != false)
		{
			$return = unlink($handle);
			if ($return == false)
			{
				$this->error = "La suppression du fichier a &eacute;chou&eacute;";
				return FALSE;
			}
			else
				return ($return);
		}
		else
		{
			$this->error = "La ressource fournie n'est pas valide.";
			return FALSE;
		}
	}
	
	public function delete_all($empty = FALSE)
	{
	    if(substr($this->currentPath,-1) == "/")
	        $this->currentPath = substr($this->currentPath,0,-1);
	    if(!file_exists($this->currentPath) || !is_dir($this->currentPath))
	        return FALSE;
		else
		{
	        $directoryHandle = $this->xopendir($this->currentPath);
	        while ($contents = $this->xreaddir($directoryHandle))
			{
				if ($contents === FALSE)
				{
					$this->error = "Erreur lors de la lecture du dossier";
					return FALSE;
				}
	            if($contents != '.' && $contents != '..')
				{
	                $path = $this->currentPath . "/" . $contents;
	                if(is_dir($path))
	                    $this->delete_all($path);
	                else
	                    $this->xunlink($path);
	            }
	        }
	        $this->xclosedir($directoryHandle);
	        if($empty == FALSE)
			{
	            if(!$this->xrmdir($this->currentPath))
	                return FALSE;
	        }
	        return true;
	    }
	}
	
	public function xmkdir ($name)
	{
		if (file_exists($this->currentPath."/".$name."/") || is_dir($this->currentPath."/".$name."/"))
		{
			$this->error = "Le dossier existe d&eacute;j&agrave; dans ce r&eacute;pertoire.";
			return FALSE;
		}
		else
		{
			$return = mkdir($this->currentPath."/".$name."/");
			if ($return == false)
			{
				$this->error = "Erreur lors de la cr&eacute;ation du dossier";
				return FALSE;
			}
			else
				return ($return);
		}
	}
	
	public function bundleGenerator ($name)
	{
		$previousItem = $this->get_currentItem();
		if ($this->xmkdir($_POST["bundle"]) === FALSE)
<<<<<<< HEAD
			return ($this->get_lastError());
		$this->set_currentItem("../../../src/".$name);
=======
			die ($this->get_lastError());
		$this->set_currentItem(ROOT."src/".$name);
>>>>>>> origin/kernel
		foreach ($folders = array("Controllers", "Entities", "Views", "Config") as $value)
		{
			$this->xmkdir($value);
		}
		$this->set_currentItem("../../../src/".$name);
		$this->xtouch("index.php");
		$this->set_currentItem("../../../src/".$name."/index.php");
		$this->replace_fileContent("<h1>Hello TiiTz</h1><h2>L'installation est terminée</h2><p>Vous pouvez commencer à utiliser TiiTz pour votre projet.<br /></p>");
		$this->set_currentItem($previousItem);
		return true;
	}
	
	public function empty_dir($empty = FALSE)
	{
		if (is_dir($this->currentPath))
		{
		    if(substr($this->currentPath,-1) == "/")
		        $this->currentPath = substr($this->currentPath,0,-1);
		    if(!file_exists($this->currentPath) || !is_dir($this->currentPath))
		        return FALSE;
			else
			{
		        $directoryHandle = $this->xopendir($this->currentPath);
		        while ($contents = $this->xreaddir($directoryHandle))
				{
					if ($contents === FALSE)
					{
						$this->error = "Erreur lors de la lecture du dossier";
						return FALSE;
					}
		            if($contents != '.' && $contents != '..')
					{
		                $path = $this->currentPath . "/" . $contents;
		                if(is_dir($path))
		                    $this->empty_dir($path);
		                else
		                    $this->xunlink($path);
		            }
		        }
		        $this->xclosedir($directoryHandle);
		        return true;
		    }
		}
		else
		{
			$this->error = "Erreur lors de la lecture du dossier";
			return FALSE;
		}
	}

	public function xtouch ($name)
	{
		if (file_exists($this->currentPath . "/" . $name) || is_dir($this->currentPath . "/" . $name))
		{
			$this->error = "Le fichier existe d&eacute;j&agrave;";
			return FALSE;
		}
		else
		{
			$return = touch($this->currentPath . "/" . $name);
			if ($return == false)
			{
				$this->error = "Erreur lors de la cr&eacute;ation du fichier";
				return FALSE;
			}
			else
				return ($return);
		}
	}
	
	public function download()
	{
		if (file_exists($this->currentPath))
		{
		    if (FALSE !== ($handler = $this->xfopen('r')))
		    {
		        header('Content-Description: File Transfer');
		        header('Content-Type: application/octet-stream');
		        header('Content-Disposition: attachment; filename='.basename($this->currentPath));
		        header('Content-Transfer-Encoding: chunked');
		        header('Expires: 0');
		        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		        header('Pragma: public');
		        while(false !== ($chunk = $this->xfread($handler,4096)))
		        {
		            echo $chunk;
		        }
		    }
		    exit;
		}
		$this->error = "Le fichier n'existe pas.";
		return FALSE;
	}
	
	public function list_all($path = "", $i = "1")
	{
		if (is_dir($this->currentPath))
		{
			if ($i == "1")
			{
				$path = $this->currentPath;
				$i = "0";
			}
		  	if ($dir = opendir($path))
		  	{
		  		$tab = array();
		    	while($file = $this->xreaddir($dir))
		    	{
		    		if (is_dir($path."/".$file))
		      			$tab[] = strtoupper($file);
					else
						$tab[] = $file;
		      		if(is_dir($path."/".$file)  && !in_array($file, array('.', '..')))
		      		array_push ($tab, $this->list_all($path."/".$file, "0"));
		    	}
		    	$this->xclosedir($dir);
		  	}
			return $tab;
		}
		else
		{
			$this->error = "Vous devez choisir un dossier et pas un fichier";
			return FALSE;
		}	
	}
	
	private function up_error($code)
	{
		switch ($code)
		{
			case UPLOAD_ERR_OK : return true;
			case UPLOAD_ERR_INI_SIZE : $this->error = 'Votre fichier `'.$this->currentPath.'` dépasse la taille maximale d\'upload autorisée par PHP( '.get_cfg_var('upload_max_filesize').' )';return FALSE;
			case UPLOAD_ERR_FORM_SIZE : $this->error = 'Votre fichier dépasse la taille maximale demandée par le Webmestre';return FALSE;
			case UPLOAD_ERR_PARTIAL : $this->error = 'Le fichier n\'a été que partiellement téléchargé. !!!';return FALSE;
			case UPLOAD_ERR_NO_FILE : $this->error = 'Aucun fichier téléchargé !!!';return FALSE;
			case UPLOAD_ERR_NO_TMP_DIR : $this->error = 'Un dossier temporaire est manquant.';return FALSE;
			case UPLOAD_ERR_CANT_WRITE : $this->error = 'Échec de l\'écriture du fichier sur le disque.';return FALSE;
			case UPLOAD_ERR_EXTENSION : $this->error = 'Une extension PHP a arrété l\'envoi de fichier. PHP ne propose aucun moyen de déterminer quelle extension est en cause. L\'examen du phpinfo() peut aider.';return FALSE;
			default : $this->error = 'L\'upload a rencontré une erreur inconnue !!!';return FALSE;
		}
	}

	public function upload()
	{
		if (is_dir($this->currentPath))
		{
			if (isset($_FILES['fichier']))
			{
				$fichier=$_FILES['fichier']['name'];
				$size=$_FILES['fichier']['size'];
				$tmp=$_FILES['fichier']['tmp_name'];
				$type=$_FILES['fichier']['type'];
				$error = $_FILES['fichier']['error'];
				$this->up_error($error);
					if (is_uploaded_file($tmp))
					{
						if ($size<="205000000")
						{
							$fichier = preg_replace ("` `i","",$fichier);
							if (file_exists('./Arbo/test2/'.$fichier))
								$nom_final = date("U").$fichier;
							else
								$nom_final=$fichier;
							move_uploaded_file($tmp,$this->currentPath.$nom_final);
						}
						else
						{
							$this->error = "Votre fichier a été rejeté (poids ou type incorrect)";
							return FALSE;
						}
					}
					else
						return FALSE;
			}
		}
		else {
			$this->error = "Vous devez choisir un dossier en element courant";
			return FALSE;
		}
	}
}


?>