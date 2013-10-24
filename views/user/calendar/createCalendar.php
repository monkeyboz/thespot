<form action="" method="POST">
    <div>
        <div style="width: 80px; float: left;">Name</div>
        <input type="text" name="calendar[name]" value="<?php echo $this->info['name']; ?>"/><?php echo $this->showError('name', 'categories'); ?>
    </div>
    <div>
        <div style="width: 80px; float: left;">Description</div><?php echo $this->showError('description', 'categories'); ?>
        <textarea name="calendar[description]" style="width: 100%;"><?php echo $this->info['description']; ?></textarea>
    </div>
    <div>
        <div style="width: 80px; float: left;">Date</div>
        <input type="text" id="calendar" name="calendar[data]" value="<?php echo $this->info['data']; ?>"/><?php echo $this->showError('date', 'categories'); ?>
    </div>
    <script>
        $('#calendar').datepicker();
    </script>
    <div id="city">
        <div style="width: 80px; float: left;">City</div>
        <input type="text" name="calendar[city]" value="<?php echo $this->info['city']; ?>"/><?php echo $this->showError('city', 'categories'); ?>
    </div>
    <div id="place">
        <div style="width: 80px; float: left;">Place</div>
        <input type="text" name="calendar[place]" value="<?php echo $this->info['place']; ?>"/><?php echo $this->showError('place', 'categories'); ?>
    </div>
    <div id="entertainers">
        <div style="width: 80px; float: left;">Enterainers</div>
        <input type="text" name="calendar[entertainer]" value="" class="entertainers"/><?php echo $this->showError('place', 'categories'); ?>
        <?php foreach($this->info['users'] as $u){
            echo '<div class="adduser itemHolder"><input type="hidden" name="adduser[]" value="'.$u.'"> <a href="" class="removeUser">-</a> '.$u.'</div><script>$(".removeUser").removeUser();</script>';
        } ?>
    </div>
    <div>
        <div style="width: 80px; float: left;">Category</div><?php echo $this->showError('category', 'categories'); ?>
        <select name="calendar[category]">
            <option value="">-Select Category-</option>
            <?php foreach($this->category as $c){ ?>
            <option value="<?php echo $c['name']; ?>" <?php if($c['name'] == $this->info['category']) echo 'selected'; ?>><?php echo $c['name']; ?></div>
            <?php } ?>
        </select>
    </div>
    <input type="hidden" name="calendar[type]" value="calendar"/>
    <input type="hidden" name="calendar[user_id]" value="<?php echo $_SESSION['user_id']; ?>"/>
    <input type="submit" value="submit" name="Submit Calendar"/>
</form>
<style>
    #entertainer_holder{
        padding: 10px;
    }
    .itemHolder{
        padding: 10px;
    }
    .completeHeader{
        background: #efefef; 
        padding: 10px;
    }
</style>
<script>
    var holder = {};
    $.fn.autoComplete = function(url, type, multi, length, linked){
        holder[type] = $(this).find('input');
        
        $.fn.getAutocomplete = function(type, multi, length){
            $(this).parent().append('<div id="'+type+'_autoComplete" class="autoComplete"><a href="" class="addUser"></a></div>');
            $(this).parent().append('<div id="'+type+'_holder" class="autoCompleteHolder"><a href="" class="addUser"></a></div>');
                            
            $(this).keyup(function(){
                var search = $(this).val();
                
                if(search.length > length){
                    search = 'data='+search;
                    $.ajax({
                        url: url+'&ajax=1',
                        data: search,
                        type: 'POST',
                        success: function(html){
                            var testing = jQuery.parseJSON(html);
                            $('#'+type+'_autocomplete').html(' ');
                            var autoCompleteString = '<div class="completeHeader">'+type+' auto complete</div>';
                            
                            $.each(testing.object, function(i, item){
                                autoCompleteString += '<div class="completeHolder">+<a href="'+testing.url+'" class="addUser">'+item+'</a><script>$(".addUser").addUser('+multi+', "'+type+'");<\/script>';
                            });
                            
                            $('#'+type+'_autoComplete').html(autoCompleteString+'</div>');
                        }
                    })
                }
            })
        }
        
        holder[type].getAutocomplete(type, multi, length);
        
        $.fn.addUser = function(multi, type){
            $(this).click(function(){
                var user = $(this).html();
                var userExists = false;
                $(this).parent().parent().find('div').remove();
                $('#'+type+'_holder').find('input').each(function(){
                    if($(this).val() == user){
                        userExists = true;
                    }
                });
                
                if(multi == true){
                    if(!userExists){
                        $('#'+type+'_holder').append('<div class="add'+type+' itemHolder"><input type="hidden" name="add'+type+'[]" value="'+user+'"> <a href="" class="removeUser">-</a> '+user+'</div><script>$(".removeUser").removeUser();<\/script>');
                    }
                } else {
                    $('#'+type+'_holder').parent().find('input').val(user);
                }
                return false;
            })
        }
        
        $.fn.removeUser = function(){
            $(this).click(function(){
                $(this).parent().remove();
                return false;
            });
        }
    }
    
    $('#entertainers').autoComplete('?page=user/checkUser/', 'user', true, 3);
    $('#place').autoComplete('?page=user/checkPlace/', 'place', false, 3);
    $('#city').autoComplete('?page=user/checkCity/', 'city', false, 3);
</script>
