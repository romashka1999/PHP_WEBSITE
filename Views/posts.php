<?php if (!isLoggedIn()): ?>
    <div class="alert alert-danger">
        <h1>User In not Logged In</h1>
    </div>
<?php endif; ?>
<?php if (isLoggedIn()): ?>
<div class="card-body p-5 blue bg-dark">

    <div class="card border-0 shadow my-5">
        <div class="card-body p-5">
            <form action="/profile/posts" method="post">
                <div>
                    <h1>Create Post</h1>
                    <form method="post" action="/contact">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Post Name</label>
                    <input type="text" class="form-control " id="exampleInputEmail1" name="postName" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Post Body</label>
                    <textarea  name="postBody" rows="2" class="form-control md-textarea " placeholder="Enter body"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" id="addPostbutton">Add New Post</button>
            </form>
        </div>
    </div>
    <?php if (isset($userPosts)): ?>
        <?php foreach($userPosts as $post) :?>
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
                    </div>
                </div>
            </div>
        <?php endforeach ;?>
    <?php endif; ?>
</div>
<?php endif; ?>