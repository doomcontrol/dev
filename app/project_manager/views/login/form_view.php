<div class="login-hold">
    <form action="/login" method="post" />
        <?php if($message): ?> 
        <div class="message-box <?=$status?>"><?=$message?></div>
        <?php endif; ?> 
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" />
        <label for="password">Password:</label>
        <input type="password" name="password" id="password"/>
        <input type="submit" value="Login" name="submit" />
    </form>
</div>