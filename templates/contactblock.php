<section id="contact" class="contactblock ps ps--darkgradient text-center" data-magellan-target="contact">
    <div class="grid-container grid-container--xnarrow">
    <h2>Contact</h2>
    <br>

    <form id="contact_form" class="contactform" action="<?= get_template_directory_uri(); ?>/contact_me.php" method="post" data-abide novalidate>
      <div class="grid-x grid-margin-x">
        <div class="cell tablet-6">
          <label for="message_name">
          Name
            <input type="text" required placeholder="Add Your name" id="message_name" name="message_name" value="<?php echo $_POST['message_name']; ?>">
          </label>
          <label for="message_email">
          E-mail
            <input type="email" required placeholder="E-mail address" id="message_email" name="message_email" value="<?php echo $_POST['message_email']; ?>">
          </label>
          <label for="message_phone">
          Telephone
            <input type="email" required placeholder="Add your phone number" id="message_phone" name="message_phone" value="<?php echo $_POST['message_phone']; ?>">
          </label>
        </div>
        <div class="cell tablet-6">
          <label for="message_text">
          How can I help You?
            <textarea required placeholder="" rows="8" id="message_text" name="message_text"><?php if ($_POST['message_text']!='') { echo $_POST['message_text']; }?></textarea>
          </label>
        </div>
      </div>
      <br>
      <div class="grid-x grid-margin-x">
        <div class="cell formactions text-center">
            <div id="result"></div>
            <input type="hidden" name="ap_id" value="<?php echo $subjecto; ?>">
            <input type="hidden" name="message_page" value="<?php the_title(); ?>">
            <input type="hidden" name="message_human" value="2">
            <input type="hidden" name="submitted" value="1">
            <button id="contact_submit" type="submit" class="button">Send A Request</button>
        </div>
      </div>


    </form>
</div>

</section>
