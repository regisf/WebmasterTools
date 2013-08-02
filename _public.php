<?php
/***************************************************************
 * WebmasterTools                                              *
 * Based on GoogleTools from Xave                              *
 *                                                             *
 * Copyright (c) 2013                                          *
 * Régis FLORET                                                *
 *                                                             *
 *  This is 'Google Stuff', a plugin for Dotclear 2            *
 *                                                             *
 *  Copyright (c) 2008                                         *
 *  xave and contributors.                                     *
 *                                                             *
 *  This is an open source software, distributed under the GNU *
 *  General Public License (version 2) terms and  conditions.  *
 *                                                             *
 *  You should have received a copy of the GNU General Public  *
 *  License along with 'My Favicon' (see COPYING.txt);         *
 *  if not, write to the Free Software Foundation, Inc.,       *
 *  59 Temple Place, Suite 330, Boston, MA  02111-1307  USA    *
 ***************************************************************/

if (!defined('DC_RC_PATH')) {return;}

$core->addBehavior('publicHeadContent',  array('webmasterToolsPublicBehaviours','publicHeadContent'));
$core->addBehavior('publicFooterContent',array('webmasterToolsPublicBehaviours','publicFooterContent'));

class webmasterToolsPublicBehaviours
{
	/*
	 * Add in the <head> tag meta tags or js
	 */
	public static function publicHeadContent($core)
	{
		$webmastertools = @$core->blog->settings->get('webmastertools') or false;
		if ($webmastertools)
		{
			$res = '';

			$verify = @$webmastertools->get('google_verify') or false;
			if ($verify) {
			    $res .= '<meta name="google-site-verification" content="' . $verify . '" />' . "\n";
			}

			$uacct = @$webmastertools->get('google_uacct') or false;
			if ($uacct) {
			    $res .= '<script type="text/javascript">' . "\n" .
				'var _gaq = _gaq || [];' . "\n" .
				'_gaq.push([\'_setAccount\', \'' . $uacct . '\']);' . "\n" .
				'_gaq.push([\'_trackPageview\']);' . "\n" .
				'</script>' . "\n";
			}

			$bing = @$webmastertools->get('bing_verify') or false;
			if ($bing) {
			    $res .= '<meta name="msvalidate.01" content="' . $bing . '" />' . "\n";
			}

			echo $res;
		}
	}

	/*
	 * Add in the footer the Google Analytics javascript
	 */
	public static function publicFooterContent($core)
	{
		$webmastertools = @$core->blog->settings->get('webmastertools') or false;
		if ($webmastertools)
		{
			$uacct = $webmastertools->get('google_uacct') or false;
			if ($uacct)
			{
				echo 	'<script type="text/javascript">'."\n".
					'(function() {'."\n".
					'var ga = document.createElement(\'script\');'."\n".
					'ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' :'.
					'\'http://www\') + \'.google-analytics.com/ga.js\';'."\n".
					'ga.setAttribute(\'async\', \'true\');'."\n".
					'document.documentElement.firstChild.appendChild(ga);'."\n".
					'})();'."\n".
					'</script>';
			}
		}
	}

}
?>
