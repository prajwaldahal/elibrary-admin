<div class="container p-5">
        <h4>Change Password</h4>
        <div class="row">
            <div class="col-md-6 col-lg-4 mx-auto">
                <div class="card rounded-lg">
                    <div class="card-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger">
                                <?= $error ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($success): ?>
                            <div class="alert alert-success">
                                <?= $success ?>
                            </div>
                        <?php endif; ?>
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="current_password">Current Password:</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                                <small id="currentPasswordHelp" class="text-danger"><?= $error ?? '' ?></small>
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password:</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                                <small id="newPasswordHelp" class="text-danger"><?= $error ?? '' ?></small>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm New Password:</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                <small id="confirmPasswordHelp" class="text-danger"><?= $error ?? '' ?></small>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
