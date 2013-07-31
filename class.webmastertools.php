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

}
