<?php
    include('class.uploader.php');
    
    $uploader = new Uploader();
    $data = $uploader->upload($_FILES['files'], array(
        'limit' => 10, //Maximum Limit of files. {null, Number}
        'maxSize' => 500, //Maximum Size of files {null, Number(in MB's)}
        'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
        'required' => false, //Minimum one file is required for upload {Boolean}
        'uploadDir' => '/var/www/gistai/app/admin/uploads/', //Upload directory {String}
        'title' => array('auto', 10), //New file name {null, String, Array} *please read documentation in README.md
        'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
        'perms' => null, //Uploaded file permisions {null, Number}
        'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
        'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
        'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
        'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
        'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
        'onRemove' => 'onFilesRemoveCallback' //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
    ));
    
    if($data['isComplete']){
        $files = $data['data'];
         // print_r($files['metas']);
		 //ConvertVideoToMp4
		 $file_ext = strtolower(end(explode('.',$files['metas'][0]['name'][0])));
		 $expensions = array("mp4");
		 if (in_array($file_ext, $expensions)){
			 echo $files['metas'][0]['name']."<<<>>>".$files['metas'][0]['name'];
		 }
		 else{
			 $SourceVideo = '/var/www/gistai/app/admin/uploads/'.$files['metas'][0]['name'];
			 $VName = random_string(5).'_'.random_string(5).'.mp4';
			 $TargetVideo = '/var/www/gistai/app/admin/uploads/'.$VName;
			 exec('sudo ffmpeg -y -i '.$SourceVideo.' '.$TargetVideo.' ');
			 unlink($SourceVideo);
			 echo $VName."<<<>>>".$VName;
		 }
    }

    if($data['hasErrors']){
        $errors = $data['errors'];
        print_r($errors);
    }
    
    function onFilesRemoveCallback($removed_files){
        foreach($removed_files as $key=>$value){
            $file = '../uploads/' . $value;
            if(file_exists($file)){
                unlink($file);
            }
        }
        
        return $removed_files;
    }
	
	function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
} 
?>
