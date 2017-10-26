<?php
/**
 * Created by PhpStorm.
 * User: saul
 * Date: 10/25/2017
 * Time: 3:18 PM
 */
echo link_tag("resources/css/Styles.css")
?>
<section id="login">
    <div class="container">
    	<div class="row">
    	    <div class="col-xs-12">
        	    <div class="form-wrap">
                <h1>Log in with your email account</h1>
                    <form role="form" name="loginForm" id="login-form" ng-submit="login(user)" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" ng-model="user.email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="key" class="sr-only">Password</label>
                            <input type="password" ng-model="user.password" name="password" id="password" class="form-control">
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Log in">
                    </form>
                    <hr>
        	    </div>
     </div> <!-- /.col-xs-12 -->
    	</div> <!-- /.row -->
    </div> <!-- /.container -->
</section>