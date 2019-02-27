<form class="w-50 mx-auto" action="/register-submit" method="post">
    <div class="form-group">
        <label for="firstName" class="small">First Name</label>
        <input type="text" class="form-control type-text" id="firstName"
               placeholder="Enter First Name" name="first_name" value="<?=session_get_flush('old', 'first_name')?>">
        <small class="form-text text-danger"><?= session_get_flush('errors', 'first_name') ?></small>
    </div>
    <div class="form-group">
        <label for="lastName" class="small">Last Name</label>
        <input type="text" class="form-control type-text" id="lastName" placeholder="Enter Last Name" name="last_name"
               value="<?=session_get_flush('old', 'last_name')?>">
        <small id="emailHelp" class="form-text text-danger"><?=session_get_flush('errors', 'last_name')?></small>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1" class="small">Email address</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
               placeholder="Enter email" name="email" value="<?=session_get_flush('old', 'email')?>">
        <small class="form-text text-danger"><?=session_get_flush('errors', 'email')?></small>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1" class="small">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password"
               value="<?=session_get_flush('old', 'password')?>">
        <small class="form-text text-danger"><?=session_get_flush('errors', 'password')?></small>
    </div>
    <div class="form-group">
        <label for="confirmPassword" class="small">Confirm Password</label>
        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password"
               name="confirm_password" value="<?=session_get_flush('old', 'confirm_password')?>">
        <small class="form-text text-danger"><?=session_get_flush('errors', 'confirm_password')?></small>
    </div>
    <button type="submit" class="btn btn-info mt-3">Register</button>
</form>