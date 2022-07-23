<?php
    include "includes/__header.php";
    include "controller/signup.inc.php";
?>
    <div class="col-lg-12">
        <div class="container">
            <div class="col-lg-4 offset-md-4 mb-4 mt-4">
                <div class="signup-form border p-4 border-primary rounded">
                    <div class="title text-center">
                        <h3 class="text-primary">Register</h3>
                    </div>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <ul class="p-0">
                            <?php if (count($error) > 0): ?>
                                <?php foreach($error as $errors): ?>
                                    <li class="bg-danger mb-2 text-white p-2 font-weight-bolder"><?php echo $errors; ?></li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                        <div class="col-lg-12 p-0">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" value="<?php echo $username; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 p-0">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                            </div>
                        </div>
                        <div class="col-lg-12 p-0">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12 p-0">
                            <div class="form-group">
                                <button type="submit" name="signupBtn" class="w-100 font-weight-bolder btn btn-primary">REGISTER</button>
                            </div>
                        </div>
                        <div class="col-lg-12 p-0">
                            <div class="form-group text-center">
                                <p>Already a member? <a href="login.php">LOGIN</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php
    include "includes/__footer.php";
?>