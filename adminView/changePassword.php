<div class="container d-flex justify-content-center align-items-center">
    <div class="col-md-8">
        <form id="changePasswordForm" method="POST" onsubmit="return changePassword()">
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" class="form-control" name="current_password" id="current_password" required>
                <small id="currentPasswordHelp" class="text-danger"></small>
            </div>

            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" class="form-control" name="new_password" id="new_password" required>
                <small id="newPasswordHelp" class="text-danger"></small>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                <small id="confirmPasswordHelp" class="text-danger"></small>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-secondary" name="change_password" style="border-radius: 15px; font-weight: bold; transition: background-color 0.3s ease-in-out, transform 0.2s;">Change Password</button>
            </div>
        </form>
    </div>
</div>
