<?php
$idir = "images/";   // Path To Images Directory
$tdir = "images/thumbs/";   // Path To Thumbnails Directory
$twidth = "125";   // Maximum Width For Thumbnail Images
$theight = "100";   // Maximum Height For Thumbnail Images

if (!isset($_GET['subpage'])) {   // Image Upload Form Below   ?>
  <form method="post" action="addphoto.php?subpage=upload" enctype="multipart/form-data">
   File:<br />
  <input type="file" name="imagefile" class="form">
  <br /><br />
  <input name="submit" type="submit" value="Sumbit" class="form">  <input type="reset" value="Clear" class="form">
  </form>
<? } else  if (isset($_GET['subpage']) && $_GET['subpage'] == 'upload') {   // Uploading/Resizing Script
  $url = $_FILES['imagefile']['name'];   // Set $url To Equal The Filename For Later Use
  if ($_FILES['imagefile']['type'] == "image/jpg" || $_FILES['imagefile']['type'] == "image/jpeg" || $_FILES['imagefile']['type'] == "image/pjpeg") {
    $file_ext = strrchr($_FILES['imagefile']['name'], '.');   // Get The File Extention In The Format Of , For Instance, .jpg, .gif or .php
    $copy = copy($_FILES['imagefile']['tmp_name'], "$idir" . $_FILES['imagefile']['name']);   // Move Image From Temporary Location To Permanent Location
    if ($copy) {   // If The Script Was Able To Copy The Image To It's Permanent Location
      print 'Image uploaded successfully.<br />';   // Was Able To Successfully Upload Image
      $simg = imagecreatefromjpeg("$idir" . $url);   // Make A New Temporary Image To Create The Thumbanil From
      $currwidth = imagesx($simg);   // Current Image Width
      $currheight = imagesy($simg);   // Current Image Height
      if ($currheight > $currwidth) {   // If Height Is Greater Than Width
         $zoom = $twidth / $currheight;   // Length Ratio For Width
         $newheight = $theight;   // Height Is Equal To Max Height
         $newwidth = $currwidth * $zoom;   // Creates The New Width
      } else {    // Otherwise, Assume Width Is Greater Than Height (Will Produce Same Result If Width Is Equal To Height)
        $zoom = $twidth / $currwidth;   // Length Ratio For Height
        $newwidth = $twidth;   // Width Is Equal To Max Width
        $newheight = $currheight * $zoom;   // Creates The New Height
      }
      $dimg = imagecreate($newwidth, $newheight);   // Make New Image For Thumbnail
      imagetruecolortopalette($simg, false, 256);   // Create New Color Pallete
      $palsize = ImageColorsTotal($simg);
      for ($i = 0; $i < $palsize; $i++) {   // Counting Colors In The Image
       $colors = ImageColorsForIndex($simg, $i);   // Number Of Colors Used
       ImageColorAllocate($dimg, $colors['red'], $colors['green'], $colors['blue']);   // Tell The Server What Colors This Image Will Use
      }
      imagecopyresized($dimg, $simg, 0, 0, 0, 0, $newwidth, $newheight, $currwidth, $currheight);   // Copy Resized Image To The New Image (So We Can Save It)
      imagejpeg($dimg, "$tdir" . $url);   // Saving The Image
      imagedestroy($simg);   // Destroying The Temporary Image
      imagedestroy($dimg);   // Destroying The Other Temporary Image
      print 'Image thumbnail created successfully.';   // Resize successful
    } else {
      print '<font color="#FF0000">ERROR: Unable to upload image.</font>';   // Error Message If Upload Failed
    }
  } else {
    print '<font color="#FF0000">ERROR: Wrong filetype (has to be a .jpg or .jpeg. Yours is ';   // Error Message If Filetype Is Wrong
    print $file_ext;   // Show The Invalid File's Extention
    print '.</font>';
  }
} ?>