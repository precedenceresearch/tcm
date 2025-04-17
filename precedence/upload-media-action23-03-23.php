<?php
$target_dir = "../insightimg/";
//$target_dir_crop = "../insightimg/crop/";
$target_file = $target_dir . basename($_FILES["img"]["name"]);
$target_crop_file = $target_dir_crop . basename($_FILES["img"]["name"]);
$uploadOk = 0;

$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$filename_without_ext = pathinfo($target_file, PATHINFO_FILENAME);


if(isset($_POST['editimg']))
{
    $imgname=base64_decode($_POST['editimg']);
    unlink($imgname);
}

   if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) 
   {
    //  list($width, $height) = getimagesize($target_file);
   
    // // Reduce width and height to half
    //  $new_width = 100;
    //  $new_height = 100;
    //  $newimage = imagecreatetruecolor($new_width,$new_height);
    //  if($imageFileType=="jpg" || $imageFileType=="jpeg")
    //  {
    //      $source = imagecreatefromjpeg($target_file);
    //  }
    //  if($imageFileType=="png")
    //  {
    //     $source = imagecreatefrompng($target_file);
    //  }
     
    //  imagecopyresampled($newimage,$source,0,0,0,0,$new_width,$new_height,$width,$height);
    //  $cropfilename=$filename_without_ext."-crop.".$imageFileType;
    //  if($imageFileType=="jpg" || $imageFileType=="jpeg")
    //  {
    //   imagejpeg($newimage,$target_dir_crop.$cropfilename);
    //  }
    //  if($imageFileType=="png")
    //  {
    //   imagepng($newimage,$target_dir_crop.$cropfilename);
    //  }
     
     
     $uploadOk = 1;
   } 
   

if($uploadOk==1)
{
    header("location:upload-media");
    exit();
}


  

?>