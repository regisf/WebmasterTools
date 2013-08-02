<html>
    <head>
    <title><?php echo __('Webmaster Tools'); ?></title>
    <style>
        a.button.wmt:active { color: black; }
        a.button.wmt { padding: 0.5em; }
        a.button.wmt:hover {
            box-shadow: 0 0 2px #000, 0 0 2px rgba(127,127,127,0.7);
        }
        a.button.wmt.red, a.button.wmt.default, a.button.wmt.green {
            color: white;
            -moz-border-radius: 0.2em;
            -webkit-border-radius: 0.2em;
            -ms-border-radius: 0.2em;
            -o-border-radius: 0.2em;
            border-radius: 0.2em;
            border: 1px solid transparent;
            text-shadow: 1px 1px 0 rgba(0,0,0,0.5);
            font-style: normal;
        }
        a.button.wmt.red {
            background: -webkit-linear-gradient(#e11d1d, #8a1d1d);
            background: -moz-linear-gradient(#e11d1d, #8a1d1d);
            background: -o-linear-gradient(#e11d1d, #8a1d1d);
            background: -ms-linear-gradient(#e11d1d, #8a1d1d);
            background: linear-gradient(#e11d1d, #8a1d1d);
        }
        a.button.wmt.green:hover {
            background: -webkit-linear-gradient(#178a17, #17b817);
            background: -moz-linear-gradient(#178a17, #17b817);
            background: -o-linear-gradient(#178a17, #17b817);
            background: -ms-linear-gradient(#178a17, #17b817);
            background: linear-gradient(#178a17, #17b817);
        }
        a.button.wmt.green {
            background: -webkit-linear-gradient(#17b817, #178a17);
            background: -moz-linear-gradient(#17b817, #178a17);
            background: -o-linear-gradient(#17b817, #178a17);
            background: -ms-linear-gradient(#17b817, #178a17);
            background: linear-gradient(#17b817, #178a17);
        }
        a.button.wmt.red:hover {
            background: -webkit-linear-gradient(#8a1d1d, #e11d1d);
            background: -moz-linear-gradient(#8a1d1d, #e11d1d);
            background: -o-linear-gradient(#8a1d1d, #e11d1d);
            background: -ms-linear-gradient(#8a1d1d, #e11d1d);
            background: linear-gradient(#8a1d1d, #e11d1d);
        }

        a.button.wmt.default {
            font-weight: bold;
            background: -webkit-linear-gradient(#2e82c9, #1d588a);
            background: -moz-linear-gradient(#2e82c9, #1d588a);
            background: -o-linear-gradient(#2e82c9, #1d588a);
            background: -ms-linear-gradient(#2e82c9, #1d588a);
            background: linear-gradient(#2e82c9, #1d588a);
        }
        a.button.wmt.default:hover {
            background: -webkit-linear-gradient(#1d588a, #2e82c9);
            background: -moz-linear-gradient(#1d588a, #2e82c9);
            background: -o-linear-gradient(#1d588a, #2e82c9);
            background: -ms-linear-gradient(#1d588a, #2e82c9);
            background: linear-gradient(#1d588a, #2e82c9);
        }
        .warning {
            background: url(../plugins/WebmasterTools/templates/warning.png); width: 128px; height: 128px; float: left;
        }
    </style>
    </head>
    <body>
        <h2 class="page-title"><?php echo __('Webmaster Tools'); ?></h2>
        <?php if (!empty($msg)): ?>
            <p class="message"><?php echo $msg; ?></p>
        <?php endif; ?>
        <?php if ($wmt->haveOldConfig() && $wmt->showWarning()): ?>
        <fieldset class="message error">
            <h2><?php echo __('Warning'); ?></h2>
            <div class="warning"></div>
            <div style="margin-left: 130px;">
                <p>
                    <?php
                        echo __("Some old Google tools plugin settings have been found.") . '<br />' .
                             __("What do you whish to do ?");
                    ?>
                </p>
            </div>
            <p style="clear:both">
                <a href="<?php echo $p_url; ?>&action=1" class="button wmt default">
                    <?php echo __('Use Google Tools configuration and remove settings'); ?>
                    </a>
                <a href="<?php echo $p_url; ?>&action=2" class="button wmt">
                    <?php echo __('Use old Google Tools configuration'); ?>
                </a>
                <a href="<?php echo $p_url; ?>&action=3" class="button wmt">
                    <?php echo __('Remove old Google Tools configuration'); ?>
                </a>
                <a href="<?php echo $p_url; ?>&action=4" class="button wmt red">
                    <?php echo __("Never mind and don't show this message again"); ?>
                </a>
            </p>
            <?php if ($core->plugins->moduleExists('googleTools')): ?>
            <p>
                <em>
                    If you enjoy <b>Webmaster Tools</b> plugin, you may desactivate Google Tools
                    <a href="<?php echo $p_url; ?>&action=5" class="button wmt green"><?php echo __("Deactivate it for me"); ?></a>
                </em>
            </p>
            <?php endif; ?>
        </fieldset>
        <?php endif; ?>

        <form method="post"  action="<?php echo($p_url); ?>">
            <?php echo $core->formNonce() . "\n"; ?>
            <fieldset>
                <legend>Google</legend>
                <div class="two-cols">
                    <div class="col">
                        <label><?php echo __('Enter here you Google Analytics Account ID'); ?></label>
                        <input type="text" name="google_uacct"
                               value="<?php echo $wmt->get('google_uacct'); ?>"
                               placeholder="<?php echo __("Your Google Analytics account"); ?>"
                               size="50" />
                    </div>

                    <div class="col">
                        <label><?php echo __('Enter here you Google Webmaster code'); ?></label>
                        <input type="text" name="google_verify"
                               value="<?php echo $wmt->get('google_verify'); ?>"
                               placeholder="<?php echo __("Your Google WMT id"); ?>"
                               size="60" />
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Bing</legend>
                    <div class="col">
                        <label><?php echo __('Enter here you\'re Bing Webmaster tool code'); ?></label>
                        <input type="text" name="bing_verify"
                               value="<?php echo $wmt->get('bing_verify'); ?>"
                               placeholder="<?php echo __("Your Bing verify ID"); ?>"
                               size="50" />
                    </div>
            </fieldset>
            <input type="submit" value="<?php echo __('Save'); ?>" />
        </form>
    </body>
</html>
