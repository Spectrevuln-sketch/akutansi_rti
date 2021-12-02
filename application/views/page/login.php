<div class="row">
  <?= $this->session->flashdata('message'); ?>
  <!-- Brand Box -->
  <div class="col-sm-6 brand">
    <a href="#" class="logo">RTI <span>.</span></a>

    <div class="heading">
      <img class="logo" src="<?= base_url(); ?>assets/img/icon.png" alt="">
      <p><?= $title; ?></p>
    </div>

    <div class="success-msg">
      <p>Great! You are one of our members now</p>
      <a href="#" class="profile">Your Profile</a>
    </div>
  </div>


  <!-- Form Box -->
  <div class="col-sm-6 form">

    <!-- Login Form -->
    <div class="login form-peice switched">
      <form class="login-form" action="<?= base_url('home'); ?>" method="post">
        <div class="form-group">
          <label for="email">Email Adderss</label>
          <input type="email" name="email" id="email" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" required>
        </div>

        <div class="CTA">
          <input type="submit" value="Login">
          <a href="#" class="switch">I'm New</a>
        </div>
      </form>
    </div><!-- End Login Form -->





    <!-- Signup Form -->
    <div class="signup form-peice">
      <form action="<?= base_url('home/register'); ?>" method="post">

        <div class="form-group">
          <label for="name">Full Name</label>
          <input type="text" name="name" id="name" class="name text-capitalize" value="<?= set_value('name'); ?>">
          <?= form_error('name', '<small class="text-danger pl-3" style="font-size:12px;">', '</small>'); ?>
        </div>

        <div class="form-group">
          <label for="email">Email Adderss</label>
          <input type="email" name="email" id="email" class="email" value="<?= set_value('email'); ?>">
          <?= form_error('email', '<small class="text-danger pl-3" style="font-size:12px;">', '</small>'); ?>
        </div>

        <div class="form-group">
          <label for="phone">Phone Number - <small>Optional</small></label>
          <input type="text" name="phone" id="phone" value="<?= set_value('phone'); ?>">
          <?= form_error('phone', '<small class="text-danger pl-3" style="font-size:12px;">', '</small>'); ?>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="pass" value="<?= set_value('password'); ?>">
          <?= form_error('password', '<small class="text-danger pl-3" style="font-size:12px;">', '</small>'); ?>
        </div>

        <div class="form-group">
          <label for="password1">Confirm Password</label>
          <input type="password" name="password1" id="password1" class="passConfirm" value="<?= set_value('password1'); ?>">
          <?= form_error('password1', '<small class="text-danger pl-3" style="font-size:12px;">', '</small>'); ?>
        </div>


        <div class="CTA">
          <button type="submit" class="badge bg-danger border-0 me-4">SIGN UP NOW</button>
          <a href="#" class="switch">I have an account</a>
        </div>
      </form>
    </div><!-- End Signup Form -->
  </div>
</div>
</div>