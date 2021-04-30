<section id="contact" class="contactblock ps ps--xdarkgradient text-center" data-magellan-target="contact">
    <div class="grid-container grid-container--xxnarrow">
    <h2><?php _e('Make an appointment','jegaden') ?></h2>
    <div class="featcard__text">
        <?php _e('Get in touch with Dr. Jegaden! We will contact you within 24 hours!', 'jegaden'); ?>
    </div>
    <br><br>

    <form id="contact_form" class="contactform" action="<?= get_template_directory_uri(); ?>/contact_me.php" method="post" data-abide novalidate>
      <div class="grid-x grid-margin-x">
        <div class="cell atablet-6">
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
        <div class="cell atablet-6">
            <label for="message_text">
            <?php _e('How can I help You?','jegaden') ?>
            <textarea required placeholder="Reason for appointment" rows="5" id="message_text" name="message_text"><?php if ($_POST['message_text']!='') { echo $_POST['message_text']; }?></textarea>
            </label>
        </div>
      </div>
      <div class="grid-x grid-margin-x">
        <div class="cell">
            <label class="checkboxlabel" for="message_topic1">
                <input id="message_topic1" type="checkbox" name="message_topic[]" value="<?php _e('I would like to discuss my problem personally with Dr. Jegaden', 'jegaden'); ?>">
                <?php _e('I would like to discuss my problem personally with Dr. Jegaden', 'jegaden'); ?>
            </label>
            <label class="checkboxlabel" for="message_topic2">
                <input id="message_topic2" type="checkbox" name="message_topic[]" value="<?php _e('Need urgent appointment (within 24-72 hours)', 'jegaden'); ?>">
                <?php _e('Need urgent appointment (within 24-72 hours)', 'jegaden'); ?>
            </label>
            <label class="checkboxlabel" for="message_topic3">
                <input id="message_topic3" type="checkbox" name="message_topic[]" value="<?php _e('Need routine appointment', 'jegaden'); ?>">
                <?php _e('Need routine appointment', 'jegaden'); ?>
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
            <button id="contact_submit" type="submit" class="button expanded large"><?php _e('Send A Request','jegaden') ?></button>
        </div>
      </div>


    </form>
</div>

</section>
