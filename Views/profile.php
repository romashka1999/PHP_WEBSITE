<?php if (!isLoggedIn()): ?>
    <div class="alert alert-danger">
        <h1>User In not Logged In</h1>
    </div>
<?php endif; ?>
<?php if (isLoggedIn()): ?>
<div class="card-body p-5 blue bg-dark">

<div style="display:flex;">
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <img class="card-img-top" src="public/userimage/<?php echo currentUser('picture'); ?>" alt="">
            <div class="card-body">
                <ul class="list-group list-group-black">
                    <li class="list-group-item"><i class="fas fa-user" style="color:red;padding-right:5px;"></i> Hello <b><?php echo currentUser('username'); ?></php></b></li>
                    <li class="list-group-item"><i class="fas fa-gem" style="color:red;padding-right:5px;"></i> Cristal <b><?php echo currentUser('cristal'); ?></php></b></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <ul class="list-group list-group-black">
                <li class="list-group-item"><h4>Name:</h4> <?php echo currentUser('name'); ?></php> </li>
                <li class="list-group-item"><h4>Lastname:</h4> <?php echo currentUser('lastname'); ?></php> </li>
                <li class="list-group-item"><h4>Username:</h4> <?php echo currentUser('username'); ?></php> </li>
                <li class="list-group-item"><h4>Email:</h4> <?php echo currentUser('email'); ?></php> </li>
                <li class="list-group-item"><a href="/profile/edit" class="btn btn-danger" style="width:150px;">Edit Profile</a></li>
                <li class="list-group-item"><a href="/profile/posts" class="btn btn-warning" style="width:150px;">My Posts</a></li>
            </ul>
        </div>
    </div>
</div>
<?php endif; ?>

