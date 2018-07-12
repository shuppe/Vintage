<?php

// ///////////////
// Floor number
// ///////////////
function echo_floor_numbers($selected_floor)
{
    $floor_select = array(
        'S5',
        'S4',
        'S3',
        'S2',
        'S1',
        'RC',
        '1st',
        '2nd',
        '3rd',
        '4th',
        '5th',
        '6th',
        '7th',
        '8th',
        '9th',
        '10th',
        '11th',
        '12th'
    );
    
    $floor_numbers = "<select name='floor'>
	";
    
    for ($i = 0; $i < count($floor_select); $i ++) {
        if ($floor_select[$i] == $selected_floor) {
            $selected = " selected";
        } else {
            $selected = "";
        }
        $floor_numbers .= "<option value='{$floor_select[$i]}'$selected>{$floor_select[$i]}</option>
";
    }
    
    $floor_numbers .= "</select>
	";
    
    return $floor_numbers;
}

/**
 * *
 * FTP
 *
 * this is a simple and complete function and
 * the easyest way i have found to allow you
 * to add an image to a form that the user can
 * verify before submiting
 *
 * if the user do not want this image and change
 * his mind he can reupload a new image and we
 * will delete the last
 *
 * i have added the debug if !move_uploaded_file
 * so you can verify the result with your
 * directory and you can use this function to
 * destroy the last upload without uploading
 * again if you want too, just add a value...
 * *
 */
function upload_back($the_dir)
{
    global $globals;
    
    /**
     * *
     * 1rst set the images dir and declare a files
     * array we will have to loop the images
     * directory to write a new name for our picture
     * *
     */
    
    $uploaddir = "../ressources/images/$the_dir/";
    $dir = opendir($uploaddir);
    $files = array();
    
    /**
     * *
     * if we are on a form who allow to reedit the
     * posted vars we can save the image previously
     * uploaded if the previous upload was successfull.
     * so declare that value into a global var, we
     * will rewrite that value in a hidden input later
     * to post it again if we do not need to rewrite
     * the image after the new upload and just... save
     * the value...
     * *
     */
    
    if (! empty($_POST['attachement_loos'])) {
        $globals['attachement'] = $_POST['attachement_loos'];
    }
    /**
     * *
     * now verify if the file exists, just verify
     * if the 1rst array is not empty.
     * else you
     * can do what you want, that form allows to
     * use a multipart form, for exemple for a
     * topic on a forum, and then to post an
     * attachement with all our other values
     * *
     */
    
    if (isset($_FILES['attachement']) && ! empty($_FILES['attachement']['name'])) {
        
        /**
         * *
         * now verify the mime, i did not find
         * something more easy than verify the
         * 'image/' ty^pe.
         * if wrong tell it!
         * *
         */
        
        if (! eregi('image/', $_FILES['attachement']['type'])) {
            // echo 'The uploaded file is not an image please upload a valide file!';
            $upload_check = false;
        } else {
            /**
             * *
             * else we must loop our upload folder to find
             * the last entry the count will tell us and will
             * be used to declare the new name of the new
             * image. we do not want to rewrite a previously
             * uploaded image
             * *
             */
            
            while ($file = readdir($dir)) {
                array_push($files, "$file");
                // echo $file;
            }
            closedir($dir);
            
            /**
             * *
             * now just rewrite the name of our uploaded file
             * with the count and the extension, strrchr will
             * return us the needle for the extension
             * *
             */
            
            $_FILES['attachement']['name'] = ceil(count($files) + '1') . '' . strrchr($_FILES['attachement']['name'], '.');
            $uploadfile = $uploaddir . basename($_FILES['attachement']['name']);
            
            /**
             * *
             * do same for the last uploaded file, just build
             * it if we have a previously uploaded file
             * **
             */
            
            $previousToDestroy = empty($globals['attachement']) && ! empty($_FILES['attachement']['name']) ? '' : $uploaddir . $files[ceil(count($files) - '1')];
            
            // now verify if file was successfully uploaded
            
            if (! move_uploaded_file($_FILES['attachement']['tmp_name'], $uploadfile)) {
                /* echo '<pre>Your file was not uploaded please try again here are your debug informations: '.print_r($_FILES) .'</pre>'; */
                $upload_check = false;
            } else {
                // echo 'image succesfully uploaded!';
                $upload_check = true;
            }
            /**
             * *
             * and reset the globals vars if we maybe want to
             * reedit the form: first the new image, second
             * delete the previous....
             * *
             */
            $globals['attachement'] = $_FILES['attachement']['name'];
            if (! empty($previousToDestroy)) {
                unlink($previousToDestroy);
            }
        }
    }
    
    if ($upload_check)
        return $_FILES['attachement']['name'];
    else
        return false;
}

function format_phone($country, $phone)
{
    $function = 'format_phone_' . $country;
    if (function_exists($function)) {
        return $function($phone);
    }
    return $phone;
}

function format_phone_canada($phone)
{
    // note: making sure we have something
    if (! isset($phone{3})) {
        return '';
    }
    // note: strip out everything but numbers
    $phone = preg_replace("/[^0-9]/", "", $phone);
    $length = strlen($phone);
    switch ($length) {
        case 7:
            return preg_replace("/([0-9]{3})([0-9]{4})/", "$1-$2", $phone);
            break;
        case 10:
            return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "($1) $2-$3", $phone);
            break;
        case 11:
            return preg_replace("/([0-9]{1})([0-9]{3})([0-9]{3})([0-9]{4})/", "$1($2) $3-$4", $phone);
            break;
        default:
            return $phone;
            break;
    }
}
?>