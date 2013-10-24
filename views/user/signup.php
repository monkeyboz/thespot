<?php $info = $this->info; ?>
<style>
    input, select{
        border: none;
        border-radius: 10px;
        padding: 5px;
    }
</style>
<div style="width: 815px; float: left;">
    <div style="margin-top: 10px; text-align: center;">
        <img src="images/signup.jpg" style="width: 100%;"/>
    </div>
    <div style="padding: 10px; color: #ababab; margin-bottom: 20px;">
        The Spot is a website where visitors and participants can post and learn about events and other 
        information about different sections in the entertainment and creative industry.  Sign-up today 
        to start participating in this online community and get the enrichment in your entertainment life.  
        There are a wide variety of experiences to choose from.  Please feel free to visit the website before 
        signing up to figure out exactly what experience you would think you would be interested in.
    </div>
    <div>
    	<form action="" method="POST" style="padding: 20px; border: 1px solid #efefef; float: left;">
    	    <h2 style="margin-bottom: 10px; padding: 0px;">SignUp Today</h2>
    	    <div style="padding: 10px; background: #000; border-radius: 10px; color: #fff; height: 126px; margin-bottom: 20px;">
        		<div style="float: left; width: 180px;">
        		    <div>
            			<div>
            				Username
            			</div>
            			<input type="text" name="user[username]" value="<?php echo $info['username']; ?>"/><?php $this->showError('username'); ?>
            		</div>
            		<div>
            			<div>
            				Password
            			</div>
            			<input type="password" name="user[password]" value="<?php echo $info['password']; ?>"/><?php $this->showError('password'); ?>
            		</div>
            	</div>
            	<div style="width: 180px; float: left;">
            	    <div>
                        <div>
                            Email
                        </div>
                        <input type="text" name="user[email]" value="<?php echo $info['email']; ?>"/><?php $this->showError('email'); ?>
                    </div>
                    <div>
                        <div>
                            Address
                        </div>
                        <input type="text" name="user[address]" value="<?php echo $info['address']; ?>"/><?php $this->showError('address'); ?>
                    </div>
            	</div>
            	<div style="width: 180px; float: left;">
            		<div>
            			<div>
            				City
            			</div>
            			<input type="text" name="user[city]" value="<?php echo $info['city']; ?>"/><?php $this->showError('city'); ?>
            		</div>
            		<div>
            			<div>
            				State
            			</div>
            			<input type="text" name="user[state]" value="<?php echo $info['state']; ?>"/><?php $this->showError('state'); ?>
            		</div>
        		</div>
        		<div style="width: 180px; float: left;">
        		    <div>
                        <div>
                            Zip
                        </div>
                        <input type="text" name="user[zip]" value="<?php echo $info['zip']; ?>"/><?php $this->showError('zip'); ?>
                    </div>
                    <div>
                        <div>UserType</div>
                        <select name="user[user_type]">
                            <option>Select User Type</option>
                            <option value="general">General User</option>
                            <option value="artist">Artist</option>
                            <option value="model">Model</option>
                            <option value="actor">Actor</option>
                            <option value="promoter">Promoter</option>
                            <option value="producer">Producer</option>
                        </select>
                    </div>
        		</div>
                <input type="submit" name="submit" value="Signup" style="margin-top: 10px;"/>
        		<div style="float: left;"></div>
        	</div>
    	</form>
    	<div style="float: left; width: 400px; margin-left: 60px;">
                <img src="images/signup_layout.jpg"/>
            </div>
    </div>
</div>