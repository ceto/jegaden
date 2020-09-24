<section id="contact" class="contactblock ps ps--darkgradient text-center" data-magellan-target="contact">
    <div class="grid-container grid-container--xnarrow">
    <h2><?php _e('Contact','jegaden') ?></h2>
    <br>

    <form id="contact_form" class="contactform" action="<?= get_template_directory_uri(); ?>/contact_me.php" method="post" data-abide novalidate>
      <div class="grid-x grid-margin-x">
        <div class="cell tablet-6">
          <label for="message_name">
          <?php _e('Name','jegaden') ?>
            <input type="text" required placeholder="<?php _e('Add your name','jegaden') ?>" id="message_name" name="message_name" value="<?php echo $_POST['message_name']; ?>">
          </label>
          <label for="message_email">
          <?php _e('E-mail','jegaden') ?>
            <input type="email" required placeholder="<?php _e('E-mail address','jegaden') ?>" id="message_email" name="message_email" value="<?php echo $_POST['message_email']; ?>">
          </label>
          <label for="message_phone">
          <?php _e('Telephone','jegaden') ?>
            <input type="tel" required placeholder="<?php _e('Add your phone number','jegaden') ?>" id="message_phone" name="message_tel" value="<?php echo $_POST['message_phone']; ?>">
          </label>
        </div>
        <div class="cell tablet-6">
          <label for="message_text">
          <?php _e('How can I help You?','jegaden') ?>
            <textarea required placeholder="" rows="8" id="message_text" name="message_text"><?php if ($_POST['message_text']!='') { echo $_POST['message_text']; }?></textarea>
          </label>
        </div>
      </div>
      <br>
      <div class="grid-x grid-margin-x">
        <div class="cell formactions text-center">
            <div id="formerror" data-abide-error class="secondary callout" style="display: none;">
            <p>
                <i class="fi-alert"></i> <?php _e('There are some error in the form. Please check your input fields.','jegaden') ?>
            </p>
            </div>
            <div id="result"></div>
            <input type="hidden" name="ap_id" value="<?php echo $subjecto; ?>">
            <input type="hidden" name="message_page" value="<?php the_title(); ?>">
            <input type="hidden" name="message_human" value="2">
            <input type="hidden" name="submitted" value="1">
            <button id="contact_submit" type="submit" class="button"><?php _e('Send A Request','jegaden') ?></button>
        </div>
      </div>


    </form>
</div>

</section>
