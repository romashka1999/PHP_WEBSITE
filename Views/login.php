<?php if (isLoggedIn()): ?>
    <div class="alert alert-danger">
        <h1> User Is Already Logged In </h1>
    </div>
<?php endif; ?>
<?php if (!isLoggedIn()): ?>
<div class="card border-0 shadow my-5">
    <div class="card-body p-5">
        <h1>Login</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <h1> <?php echo $error ;?> </h1>
            </div>
        <?php endif; ?>
        <form method="post" action="/login">
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
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control <?php if (!empty($validateError['password'])) echo 'is-invalid';else if(isset($data['password'])) echo 'is-valid'; else echo ''; ?>" id="exampleInputPassword1" name="password"
                   placeholder="Password" value="<?php if(isset($data['password'])) echo $data['password']; ?>">
                <?php if (isset($validateError['password'])): ?>
                    <div class="invalid-feedback">
                        <?php echo $validateError['password']; ?>
                    </div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Log In</button>
        </form>
    </div>
</div>
<?php endif; ?>