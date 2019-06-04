<?php if (!isLoggedIn()): ?>
    <div class="alert alert-danger">
        <h1>User In not Logged In</h1>
    </div>
<?php endif; ?>
<?php if (isLoggedIn()): ?>
<div class="card-body p-5 blue bg-dark">
        <?php if (isset($posts)): ?>
            <?php foreach($posts as $post) :?>
                <div class="row mt-4"">
                    <div class="card h-100 w-100">
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#"><?php echo $post['post_name']; ?></a>
                            </h4>
                            <hr>
                            <p class="card-text">
                                <?php echo $post['post_body']; ?>
                            </p>
                            <p class="card-text" style="color:green;">
                                Contact : <?php echo $post['email']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach ;?>
        <?php endif; ?>
</div>
<?php endif; ?>