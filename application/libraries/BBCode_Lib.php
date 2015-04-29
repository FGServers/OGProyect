<?php

/**
 * @project OGProyect
 * @version 1.0.1
 *****************************
 * @Archivo bbcode.php.
 *****************************
 * @copyright Copyright (C) 2015.
 * @copyright EX XGProyect By Lucky (C) 2008 - 2014.
 */

if ( ! defined ( 'INSIDE' ) ) { die ( header ( 'location:../../' ) ) ; }

/**
 * BBCode_Lib class.
 */
class BBCode_Lib
{
	/**
	 * __construct
	 *
	 */
	public function __construct()
	{

	}

	/**
	 * bbCode function.
	 *
	 * @access public
	 * @param string $string (default: '')
	 * @return void
	 */
	 public function bbCode ($string) {
        $tags = 'b|i|size|color|center|quote|url|img';
        while (preg_match_all('`\[('.$tags.')=?(.*?)\](.+?)\[/\1\]`', $string, $matches)) foreach ($matches[0] as $key => $match) {
            list($tag, $param, $innertext) = array($matches[1][$key], $matches[2][$key], $matches[3][$key]);
            switch ($tag) {
                case 'b': $replacement = "<strong>$innertext</strong>"; break;
                case 'i': $replacement = "<em>$innertext</em>"; break;
                case 'size': $replacement = "<span style=\"font-size: $param;\">$innertext</span>"; break;
                case 'color': $replacement = "<span style=\"color: $param;\">$innertext</span>"; break;
                case 'center': $replacement = "<div class=\"centered\">$innertext</div>"; break;
                case 'quote': $replacement = "<blockquote>$innertext</blockquote>" . $param? "<cite>$param</cite>" : ''; break;
                case 'url': $replacement = '<a href="' . ($param? $param : $innertext) . "\">$innertext</a>"; break;
                case 'img':
                    list($width, $height) = preg_split('`[Xx]`', $param);
                    $replacement = "<img src=\"$innertext\" " . (is_numeric($width)? "width=\"$width\" " : '') . (is_numeric($height)? "height=\"$height\" " : '') . '/>';
                break;
                case 'video':
                    $videourl = parse_url($innertext);
                    parse_str($videourl['query'], $videoquery);
                    if (strpos($videourl['host'], 'youtube.com') !== FALSE) $replacement = '<embed src="http://www.youtube.com/v/' . $videoquery['v'] . '" type="application/x-shockwave-flash" width="425" height="344"></embed>';
                    if (strpos($videourl['host'], 'google.com') !== FALSE) $replacement = '<embed src="http://video.google.com/googleplayer.swf?docid=' . $videoquery['docid'] . '" width="400" height="326" type="application/x-shockwave-flash"></embed>';
                break;
            }
            $string = str_replace($match, $replacement, $string);
        }
        return $string;
    } 

	/**
	 * sList function.
	 *
	 * @access private
	 * @param mixed $string
	 * @return void
	 */
	private function sList($string)
	{
		$tmp = explode('[*]', stripslashes($string));
		$out = NULL;
		foreach($tmp as $list) {
			if(strlen(str_replace('', '', $list)) > 0) {
				$out .= '<li>' . trim($list) . '</li>';
			}
		}
		return '<ul>' . $out . '</ul>';
	}

	/**
	 * imagefix function.
	 *
	 * @access private
	 * @param mixed $img
	 * @return void
	 */
	private function imagefix($img)
	{
		if(substr($img, 0, 7) != 'http://')
		{
			$img = OGP_ROOT . IMG_PATH . $img;
		}
		return '<img src="' . $img . '" alt="' . $img . '" title="' . $img . '" />';
	}

	/**
	 * urlfix function.
	 *
	 * @access private
	 * @param mixed $url
	 * @param mixed $title
	 * @return void
	 */
	private function urlfix($url, $title)
	{
		$title = stripslashes($title);
		$url   = trim($url);
		return (substr ($url, 0, 5) == 'data:' || substr ($url, 0, 5) ==  'file:' || substr ($url, 0, 11) == 'javascript:' || substr  ($url, 0, 4) == 'jar:' || substr ($url, 0, 1) == '#') ? '' : '<a  href="' . $url . '" title="'.htmlspecialchars($title,  ENT_QUOTES).'">'.htmlspecialchars($title, ENT_QUOTES).'</a>';
	}

	/**
	 * fontfix function.
	 *
	 * @access private
	 * @param mixed $font
	 * @param mixed $title
	 * @return void
	 */
	private function fontfix($font, $title)
	{
		$title = stripslashes($title);
		return '<span style="font-family:' . $font . '">' . $title . '</span>';
	}

	/**
	 * bgfix function.
	 *
	 * @access private
	 * @param mixed $bg
	 * @param mixed $title
	 * @return void
	 */
	private function bgfix($bg, $title)
	{
		$title = stripslashes($title);
		return '<span style="background-color:' . $bg . '">' . $title . '</span>';
	}

	/**
	 * sizefix function.
	 *
	 * @access private
	 * @param mixed $size
	 * @param mixed $text
	 * @return void
	 */
	private function sizefix($size, $text)
	{
		$title = stripslashes($text);
		return '<span style="font-size:' . $size . 'px">' . $title . '</span>';
	}
}
/* end of BBCode_Lib.php */