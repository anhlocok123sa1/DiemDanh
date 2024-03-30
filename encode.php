<?php
function cleanNonAsciiCharactersInString($orig_text) {

    $text = $orig_text;

    // Single letters
    $text = preg_replace("/[áàảãạâấầẩẫậăắằẳẵặ]/u",      "a", $text);
    $text = preg_replace("/[ÁÀẢÃẠÂẤẦẨẪẬĂẮẰẲẴẶ]/u",     "A", $text);
    $text = preg_replace("/[đ]/u",             "d", $text);
    $text = preg_replace("/[Đ]/u",             "D", $text);
    $text = preg_replace("/[éèẻẽẹêếềểễệ]/u", "e", $text);
    $text = preg_replace("/[ÉÈẺẼẸÊẾỀỂỄỆ]/u",     "E", $text);
    $text = preg_replace("/[ÍÌỈĨỊ]/u",           "I", $text);
    $text = preg_replace("/[íìỉĩị]/u",       "i", $text);
    $text = preg_replace("/[óòỏõọôốồổỗộơợỡởờớ]/u", "o", $text);
    $text = preg_replace("/[ÓÒỎÕỌÔỘỖỔỒỐƠỜỚỞỠỢ]/u",     "O", $text);
    $text = preg_replace("/[úùủũụưứừửữự]/u",     "u", $text);
    $text = preg_replace("/[ÚÙỦŨỤƯỨỪỬỮỰ]/u",         "U", $text);
    $text = preg_replace("/[ÝỲỶỸỴ]/u",           "Y", $text);
    $text = preg_replace("/[ýỳỷỹỵ]/u",       "y", $text);

    return $text;
}

?>