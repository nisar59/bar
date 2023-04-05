<div class="content container-sm">
      <form class="js-form-ajax revealable revealed" data-form-endpoint="/forms/submit/contact/" enctype="multipart/form-data" method="post">
        <div style="display: none;">
          <label>leave this field blank <input type="text" name="comment_body" value="">
          </label>
        </div>
        <div data-bb-track="form" data-bb-track-on="submit" data-bb-track-category="Forms" data-bb-track-action="Submit" data-bb-track-label="Contact" aria-hidden="true"></div>
        <div class="form-header"></div>
        <div class="form-ui">
          <label for="249143">
            <i class="error-label"></i>
            <span class="input-label">Name <span class="input-label-required">- Required</span>
            </span>
            <input id="249143" class="form-control" type="text" name="249143" placeholder="Name" required="">
          </label>
          <label for="249144">
            <i class="error-label"></i>
            <span class="input-label">Email <span class="input-label-required">- Required</span>
            </span>
            <input id="249144" class="form-control" type="email" name="249144" placeholder="Email" required="" autocomplete="email">
          </label>
          <label for="249145">
            <i class="error-label"></i>
            <span class="input-label">Phone Number <span class="input-label-required">- Required</span>
            </span>
            <input id="249145" class="form-control" type="text" name="249145" placeholder="Phone Number" required="" data-input-validator="phone" autocomplete="tel">
          </label>
          <label role="presentation">
            <span class="input-label" id="ae_label_select_desc0">What are you getting in touch about? <span class="input-label-optional">- Optional</span>
            </span>
            <div class="form-control-group has-icon-right">
              <select id="249146" class="form-control unselected" name="249146" aria-labelledby="ae_label_select_desc0">
                <option value="" selected="" disabled="">What are you getting in touch about?</option>
                <option value="General Inquiry">General Inquiry</option>
                <option value="Press Inquiry">Press Inquiry</option>
              </select>
              <span class="form-control-group--icon is-positioned-right" aria-hidden="true">
                <i class="fa fa-chevron-down"></i>
              </span>
            </div>
          </label>
          <label for="249147">
            <i class="error-label"></i>
            <span class="input-label">Your Message <span class="input-label-required">- Required</span>
            </span>
            <textarea id="249147" class="form-control" name="249147" placeholder="Your Message" required=""></textarea>
          </label>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-brand">Send</button>
          <span class="form-error-msg">Please check errors in the form above</span>
        </div>
        <div class="form-success-msg">
          <span>Thank you for your inquiry. We’ll be in touch shortly.</span>
        </div>
      </form>
    </div>