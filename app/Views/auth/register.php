<form class="w-50 mx-auto" action="/register-submit" method="post">
    <div class="form-group">
        <label for="firstName">First Name</label>
        <input type="text" class="form-control type-text" id="firstName"
               placeholder="Enter First Name" name="first_name">
        <div class="feedback"></div>
    </div>
    <div class="form-group">
        <label for="lastName">Last Name</label>
        <input type="text" class="form-control type-text" id="lastName" placeholder="Enter Last Name" name="last_name">
        <div class="feedback"></div>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
               placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
    </div>
    <button type="submit" class="btn btn-info">Register</button>
</form>