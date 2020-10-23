<?php   
    /**
     * Simple Image uploader by Monster Thesis.
     * 
     * PHP support 5.3+
     * 
     * @version     1.0.0
     * @author      https://www.facebook.com/MonsterThesis
     * @link        https://github.com/chromaticphdevs/php-helpers
     */

    /**
     * @param fileName $_FILES global name
     * possible options
     * [dimension(array) , prefix(string), maxSize]
     */
    function upload_multiple($fileName , $uploadPath , $prefix = 'SIMPLE-')
    {
        $isOk = true;
        /**
         * Save errors here
         */
        $errors = [];
        /**
         * Minimum size of image
         * delete minsize instance to remove file limit upload
         */
        $minSize = 100;
        /**
         * Maximum size of image
         * delete maxSize instance to remove file limit upload
         */
        $maxSize = 3000000; // three million
        
        /**
         * default dimensions
         * Width , Height
         */
        $dimension = [12000, 12000];
        /**
         * File names
         * that uploaded to the server
         */
        $uploadedFilesName = [];
        /**
         * File names
         * that uploaded to the server including the path
         */
        $uploadedFilesWithPath = [];
        /**
         * File old names
         */
        $oldNames = [];
        /**
         * Uploaded names
         */
        $allowed_ext = array('jpeg' , 'jpg' , 'png');

        $fileUploaded = $_FILES[$fileName];


        foreach($fileUploaded['name'] as $key => $value)
        {
			$fileUploadName = $fileUploaded['name'][$key];
            $fileSize  = $fileUploaded['size'][$key];

            $fileExt = explode('.' , $fileUploadName);
            $fileExt = strtolower($fileExt[1]);


            //check file size
            if(isset($minSize) && $fileSize < $minSize)
            {   
                //write minsize error
                $min = $minSize. ' bytes (' . intval($minSize / 1000) . ')kb';
                array_push($errors , "{$fileUploadName} image too small min size {$min}");
            }

            if(isset($maxSize) && $fileSize > $maxSize)
            {
                //write max size error
                //write minsize error
                $max = $maxSize. ' bytes (' . intval($maxSize / 1000) . ')kb';
                array_push($errors , "{$fileUploadName} image too large min size {$max}");
            }

			if(in_array($fileExt , $allowed_ext))
			{
                /**
                 * create new name for the uploaded file
                 */
                $uploadNewName = uniqid($prefix , true).".{$fileExt}";
				$sourcePath = $_FILES[$fileName]['tmp_name'][$key];
				$uploadFullPath = $uploadPath.DIRECTORY_SEPARATOR.$uploadNewName;

                //creates new file if not exists
				if(!file_exists($uploadPath)){
					mkdir($uploadPath);
				}

                if(move_uploaded_file($sourcePath, $uploadFullPath))
                {
					array_push($uploadedFilesName, $uploadNewName);
                    array_push($uploadedFilesWithPath, $uploadFullPath);
                    array_push($oldNames , $fileUploadName);
				}else{
                    array_push($errors , "{$fileUploadName} failed to be uploaded");
                }
            }else
            {
                array_push($errors , "{$fileUploadName} invalid extension '{$fileExt}' ");
			}
        }

        /**
         * Check if has errors
         */

        if(!empty($errors)) {
            //if has errors 
            $isOk = false;
            //empty uploaded names
            $uploadedFilesName = [];
            $uploadFullPath    = [];

            foreach($uploadedFilesName as $file) {
                //delete uploaded file to server
                unlink($file);
            }
        }

        return [
            'status' => $isOk,
            'uploads' => $uploadedFilesName,
            'errors'  => $errors,
            'path'    => $uploadPath,
            'files' => $oldNames,
            'uploadsWithPath' => $uploadedFilesWithPath
        ];
    }