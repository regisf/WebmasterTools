<?php /* -*- tab-width: 5; indent-tabs-mode: t; c-basic-offset: 5 -*- */
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

$_menu['Plugins']->addItem(
    __('Webmaster Tools'),
    'plugin.php?p=WebmasterTools',
    'index.php?pf=WebmasterTools/icon.png',
    preg_match('/plugin\.php\?p=WebmasterTools(&.*)?$/', $_SERVER['REQUEST_URI']),
    $core->auth->check('contentadmin',$core->blog->id)
);

?>
