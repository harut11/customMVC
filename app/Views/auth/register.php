<form class="w-50 mx-auto">
    <div class="form-group">
        <label for="firstName">First Name</label>
        <input type="text" class="form-control type-text" id="firstName"
               placeholder="Enter First Name" data-valid="required|min:3|max:20|name">
        <div class="feedback"></div>
    </div>
    <div class="form-group">
        <label for="lastName">Last Name</label>
        <input type="text" class="form-control type-text" id="lastName" placeholder="Enter Last Name"
               data-valid="required|min:3|max:30|name">
        <div class="feedback"></div>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-info">Register</button>
</form>