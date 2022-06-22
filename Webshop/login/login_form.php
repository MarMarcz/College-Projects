<form action="login.php" method="POST">
    <div class="form-group">
        <label>Email address:
            <input type="email" name="email" minlength="5" maxlength="320" class="form-control" placeholder="login" required>
        </label>

    </div>
    <div class="form-group">
        <label>Password:
            <input type="password" name="password" minlength="1" maxlength="127" class="form-control" placeholder="password" required>
        </label>
    </div>
    <button type="submit" class="btn btn-success">Login</button>
</form>