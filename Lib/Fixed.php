<?php
class Fixed
{
	public static function age()
	{
		return array(
				'0' => '10代未満',
				'1' => '10代',
				'2' => '20代',
				'3' => '30代',
				'4' => '40代',
				'5' => '50代',
				'6' => '60代',
				'7' => '70代',
		);
	}
	
	public static function gender()
	{
		return array(
				'1' => '女性',
				'2' => '男性',
		);
	}
}