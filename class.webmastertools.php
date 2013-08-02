<?php
/***************************************************************\
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
\***************************************************************/

class webmasterTools
{
    private $core;

    /* Ctor : Ensure the namespace exists */
    public function __construct($core)
    {
        $this->core = $core;
        $webmastertools = @$this->core->blog->settings->get('webmastertools') or false;
        if (!$webmastertools)
        {
            $this->core->blog->settings->addNameSpace('webmastertools');
            $this->core->blog->settings->webmastertools->put('google_uacct', '','string');
            $this->core->blog->settings->webmastertools->put('google_verify','','string');
            $this->core->blog->settings->webmastertools->put('bing_verify',  '','string');
        }
    }

    /* Be sure that google stuff exist
     */
    public function get($which)
    {
        $webmastertools = @$this->core->blog->settings->get('webmastertools') or false;
        if ($webmastertools)
        {
            if (!strcmp($which, 'google_verify'))
            {
                $verify = $webmastertools->get('google_verify') or false;
                if ($verify)
                {
                    return $verify;
                }
            }
            else if (!strcmp($which,'google_uacct'))
            {
                $uacct = $webmastertools->get('google_uacct') or false;
                if ($uacct)
                {
                    return $uacct;
                }
            }
            else if (!strcmp($which, 'bing_verify'))
            {
                $bing = $webmastertools->get('bing_verify') or false;
                if ($bing)
                {
                    return $bing;
                }

            }
        }
        return '';
    }

    /*
     * Register settings on POST action
     */
    public function registerSettings()
    {
        $this->core->blog->settings->addNameSpace('webmastertools');
        $this->core->blog->settings->webmastertools->put('google_uacct', empty($_POST['google_uacct'])?"" :$_POST['google_uacct'],'string');
        $this->core->blog->settings->webmastertools->put('google_verify',empty($_POST['google_verify'])?"":$_POST['google_verify'],'string');
        $this->core->blog->settings->webmastertools->put('bing_verify',  empty($_POST['bing_verify'])?"":$_POST['bing_verify'],'string');
    }

    /*
     * Test if the old config (Google Tools) still exists.
     */
    public function haveOldConfig()
    {
        return @$this->core->blog->settings->get('googlestuff') or false;

    }

    public function showWarning()
    {
        return $this->core->blog->settings->webmastertools->get('dontshowwarning');
    }

    /* Get the old config for Google Tools
     */
    public function getOld($which)
    {
        $googlestuff = @$this->core->blog->settings->get('googlestuff') or false;
        if ($googlestuff)
        {
            if (!strcmp($which, 'google_verify'))
            {
                $verify = $googlestuff->get('googlestuff_verify') or false;
                if ($verify)
                {
                    return $verify;
                }
            }

            else if (!strcmp($which,'google_uacct'))
            {
                $uacct = $googlestuff->get('googlestuff_uacct') or false;
                if ($uacct)
                {
                    return $uacct;
                }
            }
        }
        return '';
    }

    /*
     * Remove all Google Tools settings
     */
    private function _removeSettings()
    {
        $googlestuff = @$this->core->blog->settings->get('googlestuff') or false;
        if ($googlestuff)
        {
            $this->core->blog->settings->googlestuff->drop('googlestuff_uacct');
            $this->core->blog->settings->googlestuff->drop('googlestuff_verify');
            $this->core->blog->settings->dropSetting('googlestuff');
        }
    }

    /*
     * Perform a action. After that, redirect to the root plugin to display
     * correct value because of the include in pluginpath/index.php
     */
    public function doActionIfAny()
    {
        if (!empty($_GET['action']))
        {
            $action = (int)$_GET['action'];
            switch ($action)
            {
                // Use Google Tools configuration and remove settings
                case 1:
                    $uacct = $this->getOld('google_uacct');
                    $verify = $this->getOld('google_verify');
                    $this->core->blog->settings->addNameSpace('webmastertools');
                    $this->core->blog->settings->webmastertools->put('google_uacct', $uacct,'string');
                    $this->core->blog->settings->webmastertools->put('google_verify',$verify,'string');

                    $this->_removeSettings();
                    break;

                // Use old Google Tools configuration
                case 2:
                    $uacct = $this->getOld('google_uacct');
                    $verify = $this->getOld('google_verify');
                    $this->core->blog->settings->addNameSpace('webmastertools');
                    $this->core->blog->settings->webmastertools->put('google_uacct', $uacct,'string');
                    $this->core->blog->settings->webmastertools->put('google_verify',$verify,'string');
                    break;

                // Remove old Google Tools configuration
                case 3:
                    $this->_removeSettings();
                    break;

                // Never mind and don't show this message again
                case 4:
                    $this->core->blog->settings->addNameSpace('webmastertools');
                    $this->core->blog->settings->webmastertools->put('dontshowwarning', false, 'boolean');
                    break;

                // Deactivate it for me
                case 5:
                    @$this->core->plugins->deactivateModule('googleTools');
                    break;
            }

            if ($action >= 1 && $action <= 5)
            {
                $this->redirectToRoot();
            }
        }
    }

    public function redirectToRoot()
    {
        http::redirect('http://' . $_SERVER['REMOTE_ADDR'] . $_SERVER['PHP_SELF'] . '?p=WebmasterTools');
    }

}
