<?php
function cmb_dinamis($name,$table,$field,$pk,$selected) {
    $ci = get_instance();
    $cmb = "<select class='form-control' id='material-select2' size='1' name='$name' data-placeholder='Choose one..'>";
    $data = $ci->db->get($table)->result();
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  ucwords($d->$field)."</option>";
    }
    $cmb .="</select>";
    return $cmb;  
}