
<div class="card border-0 shadow my-5">
    <div class="card-body p-5">
        <div>
            <h1>Sign Up</h1>
            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <h1> <?php echo $error ;?> </h1>
                </div>
            <?php endif; ?>
            <form method="post" enctype='multipart/form-data' action="/signup">
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" class="form-control <?php if (!empty($validateError['name'])) echo 'is-invalid';else if(isset($data['name'])) echo 'is-valid'; else echo ''; ?>" id="exampleInputName1" name="name"
                           placeholder="Name" value="<?php if(isset($data['name'])) echo $data['name']; ?>">
                    <?php if (isset($validateError['name'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $validateError['name']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputLastname1">Lastname</label>
                    <input type="text" class="form-control <?php if (!empty($validateError['lastname'])) echo 'is-invalid';else if(isset($data['lastname'])) echo 'is-valid'; else echo ''; ?>" id="exampleInputLastname1" name="lastname"
                           placeholder="Lastname" value="<?php if(isset($data['lastname'])) echo $data['lastname']; ?>">
                    <?php if (isset($validateError['lastname'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $validateError['lastname']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputUsername1">Username</label>
                    <input type="text" class="form-control <?php if (!empty($validateError['username'])) echo 'is-invalid';else if(isset($data['username'])) echo 'is-valid'; else echo ''; ?>" id="exampleInputUsername1" name="username"
                           placeholder="Enter Username" value="<?php if(isset($data['username'])) echo $data['username']; ?>">
                    <?php if (isset($validateError['username'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $validateError['username']; ?>
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
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control <?php if (!empty($validateError['password'])) echo 'is-invalid';else if(isset($data['password'])) echo 'is-valid'; else echo ''; ?>" id="exampleInputPassword1" name="password"
                           placeholder="Password" value="<?php if(isset($data['password'])) echo $data['password']; ?>">
                    <?php if (isset($validateError['password'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $validateError['password']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword2">Repeat Password</label>
                    <input type="password" class="form-control <?php if (!empty($validateError['passwordRep'])) echo 'is-invalid';else if(isset($data['passwordRep'])) echo 'is-valid'; else echo ''; ?>" id="exampleInputPassword2" name="passwordRep"
                           placeholder="Repeat Password" value="<?php if(isset($data['passwordRep'])) echo $data['passwordRep']; ?>">
                    <?php if (isset($validateError['passwordRep'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $validateError['passwordRep']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-group">
                    <input type="file"  id="exampleInputPicture1"  name="picture" required>
                </div>

                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>
        </div>
    </div>
</div>
