<?php
class Filter{
    static function Set(&$r, $max=50, $exp=null, $conv=null, $default=null) {
        $exp = ($exp!==null) ? $exp : "[<>&$,'\"]";

        $r = Filter::Trim(mb_substr($r, 0, $max));
        $r = str_replace(array("\r\n", "\r"), "\n", $r);
        if ($conv) $r = mb_convert_kana($r, $conv);

        if ($exp!=="") {
            $r = str_replace("\\", "", $r);
            $r = mb_ereg_replace($exp, "", $r);
        }

        if ($default!==null && $r==="") {
            $r = $default;
        }
    }
    static function Get($prm, $max=50, $exp=null, $conv=null, $default=null) {
        $exp = ($exp!==null) ? $exp : "[<>&$,'\"]";

        $s = Filter::Trim(mb_substr($prm, 0, $max));
        $s = str_replace(array("\r\n", "\r"), "\n", $s);
        if ($conv) $s = mb_convert_kana($s, $conv);

        if ($exp!==null) {
            $s = str_replace("\\", "", $s);
            $s = mb_ereg_replace($exp, "", $s);
        }

        if ($default!==null && $s==="") {
            $s = $default;
        }
        return $s;
    }
    static function SetArray(&$ref_array, $max=50, $exp=null, $conv=null, $default=null) {
        if (!is_array($ref_array)) return false;

        for ($n=0; $n<count($ref_array); $n++) {
            $ref_array[$n] = 
                Filter::Get($ref_array[$n], $max, $exp, $conv, $default);
        }
        return true;
    }
    static function Trim($prm, $all=false, $exp="[ 　\t\r\n\0]"){
        if($all) return mb_ereg_replace($exp, "", $prm);
        else return mb_ereg_replace("^{$exp}+|{$exp}+$", "", $prm);
    }
    static function Email($prm) {
        $exp = "/^[a-zA-Z0-9_\.\-]+?@[A-Za-z0-9_\.\-]+$/";
        return preg_match($exp, $prm) ? $prm : false;
    }
    static function Date($prm) {
        $exp1 = "/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/";
        $exp2 = "/^[0-9]{4}\/[0-9]{1,2}\/[0-9]{1,2}$/";
        return (preg_match($exp1, $prm) || preg_match($exp2, $prm)) ? 
            $prm : false;
    }
    static function ZipCode($prm) {
        $exp = "/^[0-9]{3}-[0-9]{4}$/";
        return preg_match($exp, $prm) ? $prm : false;
    }
    static function PhoneNumber($prm) {
        $exp = "/^[0-9]+-[0-9]+-[0-9]+$/";
        return preg_match($exp, $prm) ? $prm : false;
    }
    static function URL($prm) {
        $exp = "/^[a-z]+:/{2}([-0-9a-zA-Z._]+(:[-0-9a-zA-Z._]+)?[@])?[-0-9a-z.]+(/[-0-9a-zA-Z_./~]*)?$/";
        return preg_match($exp, $prm) ? $prm : false;
    }
    static function EscapeTag($prm, $_escape_ = false) {
        if ($_escape_) {
                $s = str_replace("&", "_amp_", $prm);
                $s = str_replace("<", "_lt_", $s);
                $s = str_replace(">", "_gt_", $s);
        } else {
                $s = str_replace("_amp_", "&", $prm);
                $s = str_replace("_lt_", "<", $s);
                $s = str_replace("_gt_", ">", $s);
                $s = nl2br($s);
        }
        return $s;
    }
    static function Expire($prm_date, $prm_time) {
        $target = strtotime($prm_date);
        return ((time() - $target) > ($prm_time * 60));
    }
    static function RequestURL($prm_query) {
        $ptcl = ($_SERVER["HTTPS"]) ? "https" : "$http";
        $host = $_SERVER["HTTP_HOST"];
        return "{$ptcl}://{$host}/" . $_SERVER["REQUEST_URI"] . "?{$prm_quesy}";
    }
    static function Age($prm_date) {
        $ty = date("Y");
        $tm = date("m");
        $td = date("d");
        list($by, $bm, $bd) = explode('-', $prm_date);
        $age = $ty - $by;
        if ($tm * 100 + $td < $bm * 100 + $bd) $age--;
        return $age;
    }
    static function MimeEncode($prm, $encoding) {
        $org = mb_internal_encoding();
        mb_internal_encoding($encoding);

        $s = mb_encode_mimeheader($prm, $encoding);
        mb_internal_encoding($org);
        return $s;
    }
}