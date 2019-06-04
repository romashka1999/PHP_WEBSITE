<?php if (!isLoggedIn()): ?>
    <div class="alert alert-danger">
        <h1>User In not Logged In</h1>
    </div>
<?php endif; ?>
<?php if (isLoggedIn()): ?>
    <div class="card">
        <div class="card-header">
            <h3>Update User :  <b><?php echo currentUser('username');?></b></h3>
        </div>
        <div class="card-body">
            <form action="/profile/edit" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="<?php echo isset($data['name'])?$data['name']:$user['name']; ?>"
                           class="form-control <?php if (!empty($validateError['name'])) echo 'is-invalid';else if(isset($data['name'])) echo 'is-valid'; else echo ''; ?>">
                    <?php if (isset($validateError['name'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $validateError['name']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label>Lastname</label>
                    <input type="text" name="lastname" value="<?php echo isset($data['lastname'])?$data['lastname']:$user['lastname']; ?>"
                           class="form-control <?php if (!empty($validateError['lastname'])) echo 'is-invalid';else if(isset($data['lastname'])) echo 'is-valid'; else echo ''; ?>">
                    <?php if (isset($validateError['lastname'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $validateError['lastname']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" value="<?php if(isset($data['password']))echo $data['password'];?>"
                           class="form-control <?php if (!empty($validateError['password'])) echo 'is-invalid';else if(isset($data['password'])) echo 'is-valid'; else echo ''; ?>">
                    <?php if (isset($validateError['password'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $validateError['password']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label>Password Repeat</label>
                    <input type="password" name="passwordRep" value="<?php if(isset($data['passwordRep']))echo $data['passwordRep'];?>"
                           class="form-control <?php if (!empty($validateError['passwordRep'])) echo 'is-invalid';else if(isset($data['passwordRep'])) echo 'is-valid'; else echo ''; ?>">
                    <?php if (isset($validateError['passwordRep'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $validateError['passwordRep']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
<?php endif; ?>
