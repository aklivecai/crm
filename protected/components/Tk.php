<?php
class Tk
{
	const PERM_NONE = 0;
	/**
	* Translates a message to the specified language.
	* Wrapper class for setting the category correctly.
	* @param string $category message category.
	* @param string $message the original message.
	* @param array $params parameters to be applied to the message using <code>strtr</code>.
	* @param string $source which message source application component to use.
	* @param string $language the target language.
	* @return string the translated message.
	*/
	
	public static function g( $message="",$category="common", $params=array(), $source=null, $language=null)
	{
		return Yii::t(''.$category, $message, $params, $source, $language);
	}	
	
	public static function t($category="common", $message="", $params=array(), $source=null, $language=null)
	{
		return Yii::t(''.$category, $message, $params, $source, $language);
	}	
}