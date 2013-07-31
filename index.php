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

if (!defined('DC_CONTEXT_ADMIN')) { return; }

include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'class.webmastertools.php';

$wmt = new webmasterTools($core);
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $wmt->registerSettings();
}

include dirname(__FILE__) . DIRECTORY_SEPARATOR .  'templates' . DIRECTORY_SEPARATOR . 'index.php';

?>
