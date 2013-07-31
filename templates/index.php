<html>
    <head>
    <title><?php echo __('Webmaster Tools'); ?></title>
    </head>
    <body>
        <h2 class="page-title"><?php echo __('Webmaster Tools'); ?></h2>
        <?php if (!empty($msg)): ?>
            <p class="message"><?php echo $msg; ?></p>
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
