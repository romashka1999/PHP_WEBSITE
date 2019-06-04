
<div class="card border-0 shadow my-5">
    <div class="card-body p-5">
        <div>
            <h1>Contact Us</h1>
            <form method="post" action="/contact">
                <div class="form-group">
                    <label for="exampleInputEmail1">Full Name</label>
                    <input type="text" class="form-control <?php if (!empty($validateError['fullname'])) echo 'is-invalid';else if(isset($data['fullname'])) echo 'is-valid'; else echo ''; ?>" id="exampleInputEmail1" name="fullname"
                           placeholder="Enter fullname" value="<?php if(isset($data['fullname'])) echo $data['fullname']; ?>">
                    <?php if (isset($validateError['fullname'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $validateError['fullname']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="text" class="form-control <?php if (!empty($validateError['email'])) echo 'is-invalid';else if(isset($data['email'])) echo 'is-valid'; else echo ''; ?>" id="exampleInputEmail1" name="email"
                           placeholder="Enter email" value="<?php if(isset($data['email'])) echo $data['email']; ?>">
                    <?php if (isset($validateError['email'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $validateError['email']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Subject</label>
                    <input type="text" class="form-control <?php if (!empty($validateError['subject'])) echo 'is-invalid';else if(isset($data['subject'])) echo 'is-valid'; else echo ''; ?>" id="exampleInputEmail1" name="subject"
                           placeholder="Enter subject" value="<?php if(isset($data['subject'])) echo $data['subject']; ?>">
                    <?php if (isset($validateError['subject'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $validateError['subject']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Message</label>
                    <textarea  name="message" rows="2" class="form-control md-textarea <?php if (!empty($validateError['message'])) echo 'is-invalid';else if(isset($data['message'])) echo 'is-valid'; else echo ''; ?>"
                               placeholder="Enter Message"   value="<?php if(isset($data['message'])) echo $data['message']; ?>"></textarea>
                    <?php if (isset($validateError['message'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $validateError['message']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>
</div>